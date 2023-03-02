<?php

namespace arghavan\Payment\Repositories;

use arghavan\Payment\Http\Controllers\SSpost;
use arghavan\Payment\Models\Address;
use arghavan\Payment\Models\Cart;
use arghavan\Payment\Models\Code;
use arghavan\Payment\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddressRepoo
{


    public function findById($id)
    {
        return Address::query()->where('user_id',$id)->get();
    }
    public function addressId($id)
    {
        return Address::query()->where('id',$id)->get();
    }

    public function address($id,$userId)
    {
        return Address::query()->where('id',$id)->where('user_id',$userId)->get();
    }

    public function provinces()
    {
        return DB::table('provinces')->get();
    }
    public function city()
    {
        return DB::table('city')->get();
    }

    public function store($request)
    {
        return Address::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'province_id' =>$request->province,
            'city_id' =>$request->city,
            'mobile' => $request->mobile,
            'zipCode' => $request->zipCode,
            'address' => $request->address,
        ]);
    }

    public function update($addressId,$request)
    {
        Address::query()->whereId($addressId)->update([
            'name' => $request->name,
            'province_id' =>$request->province,
            'city_id' =>$request->city,
            'mobile' => $request->mobile,
            'zipCode' => $request->zipCode,
            'address' => $request->address,
        ]);
    }

    public function delete($addressId)
    {
        $address = $this->findById($addressId);
        $address->delete();
    }


    public function factor($addressId)
    {
        $factor = (new CartRepo())->all();
        $address = (new AddressRepoo())->address($addressId,auth('api')->id());

        if(count($factor) != 0)
        {
            for($i=0;$i<count($factor);$i++)
            {
                $sumPrice = $factor[$i]->where('user_id',auth('api')->id())->sum('sumPrice');
                $sumDiscount = $factor[$i]->where('user_id',auth('api')->id())->sum('sumDiscount');
                $sumWeight = $factor[$i]->where('user_id',auth('api')->id())->sum('sumWeight');
                $obj = new SSpost(22,$address[0]->province_id,$sumWeight);
                $pricePost = $obj->post(); //تومان
                $price = $sumPrice - $sumDiscount;
                $priceFinal = $price + $pricePost;
                $productId[] = $factor[$i]->product_id;
            }

            return ['sumPrice'=>$sumPrice,'sumDiscount'=>$sumDiscount,'pricePost'=>$pricePost,'priceFinal'=>$priceFinal,'productId'=>$productId];
        }
    }

//    public function storeOrder($addressId,$request)
//    {
//        dd($request['productId']);
//        $order =  Order::create([
//            'user_id' => auth()->id(),
//            'address_id' => $addressId,
//            'product_id' => $request['productId'],
//            'sumPrice' => $request['sumPrice'],
//            'sumDiscount' => $request['sumDiscount'],
//            'priceSend' => $request['pricePost'],
//            'priceFinal' => $request['priceFinal'],
//            'keyOrders' => Str::random(30)
//
//            ]);
//        if($order)
//        {
//            $orders = DB::table('order-details')
//                ->where('user_id',auth('api')->id())
//                ->where('product_id',);
////            $orders = Cart::query()->where('user_id',auth('api')->id())->where('product_id',$request->id)->get();
//            if(count($cart) != 0)
//            {
//                $id = $cart[0]->id;
//                Cart::query()->whereId($id)->update([
//                    'numbers' => $cart[0]->numbers + 1,
//                    'sumPrice' => $cart[0]->sumPrice + $cart[0]->price,
//                    'sumDiscount' => $cart[0]->sumDiscount + $cart[0]->discount,
//                    'sumWeight' => $cart[0]->sumWeight + $cart[0]->weight,
//                ]);
//            }
//            else
//            {
//                return Cart::create([
//                    'user_id' => auth('api')->id(),
//                    'product_id' => $request->id,
//                    'numbers' => $request->count,
//                    "price" => $product->price,
//                    "discount" => $product->discount == null ? 0 : $product->discount ,
//                    "weight" => $product->weight ,
//                    "sumPrice" => $product->price,
//                    "sumDiscount" => $product->discount == null ? 0 : $product->discount ,
//                    "sumWeight" => $product->weight ,
//                    "photo" => $product->image_id
//                ]);
//            }
//            $cart = Cart::query()->where('user_id',auth('api')->id())->get();
//            $cart->delete();
//        }
//    }
}
