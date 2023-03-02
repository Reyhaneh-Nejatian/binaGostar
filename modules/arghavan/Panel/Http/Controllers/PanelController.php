<?php

namespace arghavan\Panel\Http\Controllers;


use App\Http\Controllers\Controller;
use arghavan\Panel\Repositories\PanelRepo;
use arghavan\Payment\Repositories\CodeRepo;
use arghavan\Payment\Repositories\OrderRepo;
use arghavan\Payment\Repositories\PaymentRepo;
use arghavan\User\Http\Requests\UpdateProfileInformationRequest;
use arghavan\User\Repositories\UserRepo;

class PanelController extends Controller
{
    public $panelRepo;
    public function __construct(PanelRepo $panelRepo)
    {
        $this->panelRepo = $panelRepo;
    }
    public function index()
    {
        return response()->json('نمایش ویو صفحه اول پنل کاربری');
    }

    public function profile()
    {
        $name = auth('api')->user()->name;
        $email = auth('api')->user()->email;
        $mobile = auth('api')->user()->mobile;
        return response()->json([$name,$email,$mobile]);
    }

    public function updateProfile(UpdateProfileInformationRequest $request)
    {
        $this->panelRepo->updateProfile($request);
        return response()->json('اطلاعات با موفقیت اپدیت شد');
    }

    public function purchases()
    {
        //ردیف - مبلغ پرداختی - هزینه ارسال - جزئیات سفارش - وضعیت سفارش - کد پیگیری
        $orders = $this->panelRepo->purchases();
        return response()->json($orders);
    }

    public function purchasesDetails($orderId)
    {
        $orders = $this->panelRepo->orderDetails($orderId);
        return response()->json($orders);
    }
}
