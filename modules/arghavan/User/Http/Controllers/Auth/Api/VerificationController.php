<?php

namespace arghavan\User\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use arghavan\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use arghavan\User\Http\Requests\VerifyCodeRequest;
use arghavan\User\Services\VerifyCodeService;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

//    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? true
            :  response([
                'message' => 'Display the verification page.'
            ],200);
    }

    public function verify(VerifyCodeRequest $request)
    {
        if(!VerifyCodeService::check(auth()->id(),$request->verify_code)){

            return response()->json('کد وارد شده معتبر نمی باشد');
        }

        auth()->user()->markEmailAsVerified();

        return response()->json([
            'message' => 'کاربر با موفقیت اکتیو شد',
        ]);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

            $user = User::query()->findOrFail(auth()->id());
            event(new Registered($user));

            return response('کد فعالسازی به ایمیلتان ارسال شد');
    }

}
