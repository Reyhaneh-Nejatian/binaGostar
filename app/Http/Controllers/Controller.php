<?php

namespace App\Http\Controllers;

use arghavan\Payment\Gateways\Zarinpal\Zarinpa;
use arghavan\Payment\Models\Payment;
use arghavan\Payment\Repositories\AddressRepoo;
use arghavan\Payment\Repositories\OrderRepo;
use arghavan\Payment\Repositories\PaymentRepo;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public function buy()
//    {
//        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
//        $Amount = 100;
//        $Description = "تراکنش زرین پال";
//        $Email = "";
//        $Mobile = "";
//        $CallbackURL = route('callback');
//        $ZarinGate = false;
//        $SandBox = true;
//
//        $zp = new zarinpa();
//
//        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox);
//        if (isset($result["Status"]) && $result["Status"] == 100) {
//            // Success and redirect to pay
//            $zp->redirect($result["StartPay"]);
//        } else {
//            // error
//            echo "خطا در ایجاد تراکنش";
//            echo "<br />کد خطا : " . $result["Status"];
//            echo "<br />تفسیر و علت خطا : " . $result["Message"];
//        }
//    }
//
//    public function callback()
//    {
//
//        $MerchantID = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
//        $Amount = 100;
//        $ZarinGate = false;
//        $SandBox = true;
//
//        $zp = new zarinpa();
//        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);
//
//        if (isset($result["Status"]) && $result["Status"] == 100) {
//            // Success
//            echo "تراکنش با موفقیت انجام شد";
//            echo "<br />مبلغ : " . $result["Amount"];
//            echo "<br />کد پیگیری : " . $result["RefID"];
//            echo "<br />Authority : " . $result["Authority"];
//        } else {
//            // error
//            echo "پرداخت ناموفق";
//            echo "<br />کد خطا : " . $result["Status"];
//            echo "<br />تفسیر و علت خطا : " . $result["Message"];
//        }
//    }
}
