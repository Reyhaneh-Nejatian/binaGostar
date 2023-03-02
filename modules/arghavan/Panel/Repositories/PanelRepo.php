<?php


namespace arghavan\Panel\Repositories;


use arghavan\Payment\Models\Order;
use arghavan\Payment\Models\orderDetail;
use arghavan\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PanelRepo
{
    public $query;
    public function __construct()
    {
        $this->query = User::query();
    }

    public function updateProfile($request)
    {
        if(auth('api')->user()->email != $request->email){

            auth('api')->user()->email = $request->email;
            auth('api')->user()->email_verified_at = null;
        }

        auth('api')->user()->username = $request->username;
        auth('api')->user()->mobile = $request->mobile;

        if($request->password){
            auth('api')->user()->password = Hash::make($request->password);
        }

        auth('api')->user()->save();
    }

    public function purchases()
    {
        return Order::query()->where('payment_status',Order::STATUS_PAID)
            ->where('user_id',auth('api')->id())->with('codes')
            ->latest()->get(['priceFinal','priceSend','id','status']);
    }

    public function orderDetails($orderId)
    {
        return orderDetail::query()->where('order_id',$orderId)->with('product')->get(['product_id','numbers','price','discount','weight']);
    }
}
