@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="کاربران">ویرایش کاربر</a></li>
@endsection

@section('content')
    <div class="row no-gutters margin-bottom-20">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی پروفایل</p>
            <x-user-photo />
            <form action="{{ route('admin.updateProfile')}}" class="padding-30" method="post">
                @csrf
                <x-input name="username" placeholder="نام کاربری" type="text" value="{{ auth()->user()->username }}" required/>
                <x-input type="text" name="email" placeholder="ایمیل" value="{{ auth()->user()->email }}" class="text-left" required />
                <x-input type="text" name="mobile" placeholder="موبایل" value="{{ auth()->user()->mobile }}" class="text-left"  />
                <x-input type="password" name="password" placeholder="پسورد جدید" value=""  />
                <x-input type="password" name="password_confirmation" placeholder="تکرار پسورد جدید" value=""  />
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی پروفایل</button>
            </form>
        </div>
    </div>
@endsection
