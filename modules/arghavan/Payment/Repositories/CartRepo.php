<?php

namespace arghavan\Payment\Repositories;

use arghavan\Payment\Models\Address;
use arghavan\Payment\Models\Cart;
use arghavan\Product\Models\Product;
use Illuminate\Support\Facades\DB;

class CartRepo
{

    public function store($request)
    {
        $product = Product::query()->where('id',$request->id)->first();
        if($product->numbers != 0)
        {
            $cart = Cart::query()->where('user_id',auth('api')->id())->where('product_id',$request->id)->get();
            if(count($cart) != 0)
            {
                $id = $cart[0]->id;
                Cart::query()->whereId($id)->update([
                    'numbers' => $cart[0]->numbers + 1,
                    'sumPrice' => $cart[0]->sumPrice + $cart[0]->price,
                    'sumDiscount' => $cart[0]->sumDiscount + $cart[0]->discount,
                    'sumWeight' => $cart[0]->sumWeight + $cart[0]->weight,
                ]);
            }
            else
            {
                return Cart::create([
                    'user_id' => auth('api')->id(),
                    'product_id' => $request->id,
                    'numbers' => 1,
                    "price" => $request->price,
                    "discount" => $request->discount == null ? 0 : $request->discount ,
                    "weight" => $request->weight ,
                    "sumPrice" => $request->price,
                    "sumDiscount" => $request->discount == null ? 0 : $request->discount ,
                    "sumWeight" => $request->weight ,
                    "photo" => $request->image_id
                ]);
            }
        }else{
            return response()->json('موجودی کافی نمی باشد');
        }

    }

    public function add($request)
    {
        $product = $this->findById($request->id);
        $cart = Cart::query()->where('user_id',auth('api')->id())->where('product_id',$request->id)->get();
        if(count($cart) != 0)
        {
            $id = $cart[0]->id;
            Cart::query()->whereId($id)->update([
                'numbers' => $cart[0]->numbers + 1,
                'sumPrice' => $cart[0]->sumPrice + $cart[0]->price,
                'sumDiscount' => $cart[0]->sumDiscount + $cart[0]->discount,
                'sumWeight' => $cart[0]->sumWeight + $cart[0]->weight,
            ]);
        }
        else
        {
            return Cart::create([
                'user_id' => auth('api')->id(),
                'product_id' => $request->id,
                'numbers' => $request->count,
                "price" => $product->price,
                "discount" => $product->discount == null ? 0 : $product->discount ,
                "weight" => $product->weight ,
                "sumPrice" => $product->price,
                "sumDiscount" => $product->discount == null ? 0 : $product->discount ,
                "sumWeight" => $product->weight ,
                "photo" => $product->image_id
            ]);
        }
    }

    public function removeCart($request)
    {
        $cart = Cart::query()->where('user_id',auth('api')->id())->where('product_id',$request->id)->get();
        if(count($cart) != 0)
        {
            $id = $cart[0]->id;
            if($cart[0]->numbers == 1)
            {

                $cart = Cart::query()->findOrFail($id);
                $cart->delete();
                return 1;
            }
            else
            {
                Cart::query()->whereId($id)->update([
                    'numbers' => $cart[0]->numbers - 1,
                    'sumPrice' => $cart[0]->sumPrice - $cart[0]->price,
                    'sumDiscount' => $cart[0]->sumDiscount - $cart[0]->discount,
                    'sumWeight' => $cart[0]->sumWeight - $cart[0]->weight,
                ]);
                return 2;
            }

        }
    }

    public function remove($request)
    {
        $cart = Cart::query()->where('user_id',auth('api')->id())->where('product_id',$request->id)->get();
        if(count($cart) != 0)
        {
            $id = $cart[0]->id;
            $cart = Cart::query()->findOrFail($id);
            $cart->delete();
        }
    }

    public function all()
    {
        $cart = Cart::query()->where('user_id',auth('api')->id())->get();
        return $cart;
    }


}
