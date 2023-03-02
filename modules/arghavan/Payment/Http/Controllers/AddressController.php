<?php

namespace arghavan\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Payment\Gateways\Zarinpal\Zarinpa;
use arghavan\Payment\Http\Requests\AddressRequest;
use arghavan\Payment\Repositories\AddressRepoo;
use arghavan\Payment\Repositories\CartRepo;
use arghavan\Payment\Repositories\OrderRepo;
use arghavan\Payment\Repositories\PaymentRepo;
use arghavan\Product\Models\Product;
use arghavan\Product\Repositories\ProductRepo;
use Evryn\LaravelToman\Facades\Toman;


class AddressController extends Controller
{
    public $addressRepo;
    public function __construct(AddressRepoo $addressRepo)
    {
        $this->addressRepo = $addressRepo;
    }

    public function index()
    {
        $provinces = $this->addressRepo->provinces();
        $city = $this->addressRepo->city();
        $addresses = $this->addressRepo->findById(auth()->id());
        return response()->json([$provinces,$city,$addresses]);
    }

    public function store(AddressRequest $request)
    {
        $address = $this->addressRepo->store($request);
        return response()->json(['اطلاعات با موفقیت ثبت شد']);
    }

    public function edit($id)
    {
        $address = $this->addressRepo->addressId($id);
        return response()->json($address);
    }

    public function update($id,AddressRequest $request)
    {
        $this->addressRepo->update($id,$request);
        return response()->json('عملیات با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $this->addressRepo->delete($id);
    }

    public function factor($addressId)
    {
        $factor = (new AddressRepoo())->factor($addressId);
        if(!is_null($factor))
        {
            return response()->json(['sumPrice'=>$factor['sumPrice'],'sumDiscount'=>$factor['sumDiscount'],'pricePost'=>$factor['pricePost'],'priceFinal'=>$factor['priceFinal']]);
        }
        else
        {
            return response()->json('سبد خرید شما خالی می باشد.');
        }
    }

    public function buy($addressId)
    {

        $factor = (new AddressRepoo())->factor($addressId);
        $numbers = (new OrderRepo())->checkNumber();
        if(is_array($numbers) && $numbers != [])
        {
            if(count($numbers) != 0)
            {
                for ($i=0;$i<count($numbers);$i++)
                {
                    $products[] = Product::query()->where('id',$numbers[$i])->get();
                }
            }
            return response()->json(['موجودی کافی نمی باشد','product_id'=>$products]);
        }else{
            $order = (new OrderRepo())->storeOrder($addressId,$factor);
            $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
            $description = 'خرید از سایت بینا گستر';
            $Email = "";
            $Mobile = "";
            $CallbackURL = route('payments.callback');
            $zp = new zarinpa();
            $result = $zp->request($MerchantID, $order->priceFinal, $description, $Email, $Mobile, $CallbackURL, true);
            $payment = (new PaymentRepo())->store($order->priceFinal,$order->id,$order->keyOrders,$result['Authority']);
            if (isset($result["Status"]) && $result["Status"] == 100) {
                // Success and redirect to pay
                return response()->json($result["StartPay"]);
            } else {
                // error

                return response()->json([$result["Status"],$result['Message']]);
            }
        }
    }
}
