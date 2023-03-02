<?php

namespace arghavan\Payment\Repositories;

use arghavan\Payment\Models\Cart;
use arghavan\Payment\Models\Order;
use arghavan\Payment\Models\orderDetail;
use arghavan\Product\Models\Product;
use arghavan\Product\Repositories\ProductRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepo
{

    public function checkNumber()
    {
        $cart = (new CartRepo())->all();
        $number = [];
        if(count($cart) != 0)
        {
            for($i=0;$i<count($cart);$i++)
            {
                $product = (new ProductRepo())->findById($cart[$i]->product_id);
                if($product->numbers >= $cart[$i]->numbers)
                {

                }
                else
                {
                    $number[] = $product->id;
//                    return $product->id;
//                    return response()->json(['موجودی کافی نمی باشد',$product->id]);
                }

            }
            return $number;
        }
    }

    public function storeOrder($addressId,$request)
    {
        $cart = (new CartRepo())->all();
        if(count($cart) != 0)
        {
            for($i=0;$i<count($cart);$i++)
            {
                $product = (new ProductRepo())->findById($cart[$i]->product_id);
                if($product->numbers >= $cart[$i]->numbers)
                {
                    $order =  Order::create([
                        'user_id' => auth()->id(),
                        'address_id' => $addressId,
                        'sumPrice' => $request['sumPrice'],
                        'sumDiscount' => $request['sumDiscount'],
                        'priceSend' => $request['pricePost'],
                        'priceFinal' => $request['priceFinal'],
                        'keyOrders' => Str::random(30)

                    ]);
                    if($order)
                    {
                        $factor = (new CartRepo())->all();
                        foreach ($factor as $item)
                        {

                            DB::table('order-details')->insert([
                                'user_id' => auth('api')->id(),
                                'order_id' => $order->id,
                                'product_id' => $item->product_id,
                                'discount' => $item->discount,
                                'price' => $item->price,
                                'weight' => $item->weight,
                                'numbers' => $item->numbers,
                            ]);
                        }

                    }
                    $factor = (new CartRepo())->all();
                    $factor->each->delete();

                    return $order;

                }else{

                }
            }

            }

        }


    public function changeStatus($id, string $status){

        return Order::query()->whereId($id)->update([
            'payment_status' => $status
        ]);
    }

    public function orderDetails($orderId)
    {
        return orderDetail::query()->where('order_id',$orderId)->get(['product_id','numbers','price','discount','weight']);
    }

    public function updatePaymentStatus($orderId, $status)
    {
        return Order::query()->whereId($orderId)->update(['status' => $status]);
    }
}
