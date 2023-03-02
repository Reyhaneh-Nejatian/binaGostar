<?php

namespace arghavan\Dashboard\Http\Controllers;


use App\Http\Controllers\Controller;
use arghavan\Payment\Repositories\PaymentRepo;
use arghavan\RolePermissions\Models\Role;
use arghavan\User\Models\User;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{

    public function home(PaymentRepo $paymentRepo)
    {
//        if(auth()->check()->)
        $last30DaysTotal = $paymentRepo->getLastNDaysTotal(-30);
        $totalSell = $paymentRepo->getLastNDaysTotal();
        $todaysIncome = $paymentRepo->getTodaysIncome(now());
        $todaySuccessPaymentsCount = $paymentRepo->getNumberSuccessfulTransaction(now());
        $payments = $paymentRepo->lately();
        return view('Dashboard::index', compact('totalSell','last30DaysTotal','todaysIncome',
            'todaySuccessPaymentsCount','payments'));
    }


}
