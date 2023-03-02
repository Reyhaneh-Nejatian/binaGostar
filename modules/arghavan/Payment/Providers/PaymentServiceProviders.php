<?php

namespace arghavan\Payment\Providers;

use arghavan\Payment\Gateways\Gateway;
use arghavan\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
use arghavan\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProviders extends ServiceProvider
{
//    public $namespace = "arghavan\Payment\Http\Controllers";
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__.'/../Routes/address_routes.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/payment_routes.php');
        $this->loadRoutesFrom(__DIR__.'/../Routes/code_routes.php');

//        Route::middleware("auth:api")->namespace($this->namespace)->group(__DIR__ . "/../Routes/payment_routes.php");

        $this->loadViewsFrom(__DIR__ . '/../Resources/Views','Payment');

        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');

    }

    public function boot()
    {

        config()->set('sidebar.items.payments',[
            'icon' => 'i-transactions',
            'title' => 'تراکنش ها',
            'url' => route('payments.index'),
            'permission' => Permission::PERMISSION_SUPER_ADMIN,
        ]);

        config()->set('sidebar.items.orders',[
            'icon' => 'i-my__purchases',
            'title' => 'سفارش ها',
            'url' => route('orders.index'),
            'permission' => Permission::PERMISSION_SUPER_ADMIN,
        ]);

//        config()->set('sidebar.items.my-purchases', [
//            "icon" => "i-my__purchases",
//            "title" => "خریدهای من",
//            "url" => route('purchases.index'),
//        ]);

    }
}
