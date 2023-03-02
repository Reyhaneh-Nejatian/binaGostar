<?php

namespace arghavan\User\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use arghavan\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use arghavan\User\Http\Requests\SendResetPasswordVerifyCodeRequest;
use arghavan\User\Repositories\UserRepo;
use arghavan\User\Services\VerifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showVerifyCodeRequestForm()
    {
        return response('صفحه ارسال ایمیل برای بازیابی رمز');
//        return view('User::Front.passwords.email');
    }

    public function sendVerifyCodeEmail(SendResetPasswordVerifyCodeRequest $request, UserRepo $userRepo)
    {
        $user = $userRepo->findByEmail($request->email);

        if($user && !VerifyCodeService::has($user->id)){

            $user->sendResetPasswordRequestNotification();
        }

        return response('کد بازیابی رمز عبور شما ارسال شد');

//        return view('User::Front.passwords.enter-verify-code-form');
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if($user == null || !VerifyCodeService::check($user->id,$request->verify_code))
        {
            return response('کد وارد شده معتبر نمیباشد!');
//            return back()->withErrors(['verify_code' => 'کد وارد شده معتبر نمیباشد!']);
        }
        auth()->loginUsingId($user->id);

        return response('کد معتبر بود و نمایش صفحه تغییر رمز عبور');
//        return redirect()->route('password.showResetForm');
    }
}
