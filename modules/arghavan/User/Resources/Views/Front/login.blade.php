@extends('User::Front.master')

@section('content')
    <div class="account-box-title text-right">ورود به به پنل</div>
    <div class="account-box-content">
        <form class="form-account" method="post" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-account-title">ایمیل یا شماره موبایل</div>
            <div class="form-account-row">
                <input class="input-field " type="text" name="email"
                       autofocus value="{{ old('email') }}" required autocomplete="email"
                       placeholder=" ایمیل یا شماره موبایل خود را وارد نمایید">

                @error("email")
                <span role="alert">
                    <strong style="color: red">{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-account-title">رمز عبور
                <a href="{{ route('password.request') }}" class="btn-link-border form-account-link">رمز
                    عبور خود را فراموش
                    کرده ام</a>
            </div>
            <div class="form-account-row">
                <input class="input-field" type="password" name="password"
                       value="{{ old('password') }}" required autocomplete="password"
                       placeholder="کلمه عبور خود را وارد نمایید">
                @error("password")
                <span role="alert">
                    <strong style="color: red">{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-account-row form-account-submit">
                <div class="parent-btn">
                    <button class="dk-btn dk-btn-info">
                        ورود به پنل
                        <i class="fa fa-sign-in"></i>
                    </button>
                </div>
            </div>
            <div class="form-account-agree">
                <label class="checkbox-form checkbox-primary">
                    <input name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkbox-check"></span>
                </label>
                <label for="agree">مرا به خاطر داشته باش</label>
            </div>
        </form>
    </div>

@endsection

