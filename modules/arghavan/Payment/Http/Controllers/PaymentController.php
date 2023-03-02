<?php

namespace arghavan\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Payment\Gateways\Zarinpal\Zarinpa;
use arghavan\Payment\Models\Code;
use arghavan\Payment\Models\Order;
use arghavan\Payment\Models\Payment;
use arghavan\Payment\Repositories\OrderRepo;
use arghavan\Payment\Repositories\PaymentRepo;
use arghavan\Product\Repositories\ProductRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public $orderRepo;
    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index(PaymentRepo $paymentRepo,Request $request)
    {
        $this->authorize('manage',Payment::class);

        $payments = $paymentRepo
            ->searchEmail($request->email)
            ->searchAmount($request->amount)
            ->searchInvoiceId($request->invoice_id)
            ->searchStatus($request->status)
//            ->searchAfterDate($this->dateFromJalali($request->start_date)) // در هلپرز ماژول کامان
////            ->searchBeforeDate(dateFromJalali( $request->end_date))
            ->paginate();

        return view("Payment::index",compact('payments'));
    }

    public function orders(PaymentRepo $paymentRepo)
    {
        $orders = $paymentRepo->orders();
        return view("Payment::orders",compact('orders'));
    }

    public function preparing($orderId)
    {
        $this->orderRepo->updatePaymentStatus($orderId, Order::TYPE_PREPARING);
    }

    public function delivered($orderId)
    {
        $this->orderRepo->updatePaymentStatus($orderId, Order::TYPE_DELIVERED);
    }

    public function posted($orderId)
    {
        $this->orderRepo->updatePaymentStatus($orderId, Order::TYPE_POSTED);
    }

    public function callback(Request $request)
    {
        $paymentRepo = new PaymentRepo();
        $orderRepo = new OrderRepo();
        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";

        $payment = (new PaymentRepo())->findByInvoiceId($request->Authority);

        if(!$payment){
            return response()->json('تراکنش مورد نظر یاقت نشد!');
//            return redirect('/');
        }

        $oroderId = Order::query()->where('keyOrders',$payment->keyOrders)->first('id');
        $orders = DB::table('order-details')->where('order_id',$oroderId->id)->get();
//        dd($orders[0]->product_id);

        $zp = new zarinpa();
        $result = $zp->verify($MerchantID, $payment->amount, true);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success
            $paymentRepo->changeStatus($payment->id, Payment::STATUS_SUCCESS);
            $orderRepo->changeStatus($payment->order_id, Order::STATUS_PAID);
            if(count($orders) != 0)
            {
                for($i=0;$i<count($orders);$i++)
                {
                    (new ProductRepo())->decreasingInventory($orders[$i]->product_id,$orders[$i]->numbers);
                }
            }

            return response()->json(['پرداخت با موفقیت انجام شد.','کد پیگیری'=>$result["RefID"]]);

        } else {
            // error
            $paymentRepo->changeStatus($payment->id, Payment::STATUS_FAIL);
            $orderRepo->changeStatus($payment->order_id, Order::STATUS_UNPAID);
            return response()->json($result['Message']);
        }
    }

    public function orderDetails($orderId)
    {
        $orders = $this->orderRepo->orderDetails($orderId);
        return view('Payment::orderDetails',compact('orders'));
    }

    public function trackingCode($orderId)
    {
        $codes = Code::query()->where('order_id',$orderId)->get();
        return view('Payment::code',compact('orderId','codes'));
    }
}
