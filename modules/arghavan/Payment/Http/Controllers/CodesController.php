<?php

namespace arghavan\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use arghavan\Payment\Gateways\Zarinpal\Zarinpa;
use arghavan\Payment\Http\Requests\AddressRequest;
use arghavan\Payment\Models\Code;
use arghavan\Payment\Repositories\AddressRepoo;
use arghavan\Payment\Repositories\CartRepo;
use arghavan\Payment\Repositories\CodeRepo;
use arghavan\Payment\Repositories\OrderRepo;
use arghavan\Payment\Repositories\PaymentRepo;
use arghavan\Product\Models\Product;
use arghavan\Product\Repositories\ProductRepo;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CodesController extends Controller
{
    public $codeRepo;
    public function __construct(CodeRepo $codeRepo)
    {
        $this->codeRepo = $codeRepo;
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'code' => ['required', 'string', 'max:24'],
            'orderId' => ['required'],
        ]);
        $coses = $this->codeRepo->store($request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->back();
    }


    public function edit($id)
    {
        $code = $this->codeRepo->findById($id);
        return view('Payment::codeEdit',compact('code'));
    }

    public function update($id,Request $request)
    {
        $data = Validator::make($request->all(), [
            'code' => ['required', 'string', 'max:24'],
            'orderId' => ['required'],
        ]);
        $this->codeRepo->update($id,$request);
        toastr()->success('عملیات با موفقیت انجام شد!','موفق');
        return redirect()->route('payment.code',$request->orderId);
    }

    public function destroy($codeId)
    {
        (new CodeRepo())->delete($codeId);
    }
}
