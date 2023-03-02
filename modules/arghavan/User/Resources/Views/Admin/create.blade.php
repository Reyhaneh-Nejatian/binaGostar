@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ایجاد کاربر">ایجاد کاربر</a></li>
@endsection

@section('content')
    <div class="row no-gutters margin-bottom-20">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد کاربر</p>
            <form action="{{ route('users.store') }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <x-input name="name" placeholder="نام کاربر" type="text" required/>
                <x-input type="text" name="email" placeholder="ایمیل" class="text-left" required />
                <x-input type="text" name="username" placeholder="نام کاربری" class="text-left"  />
                <x-input type="text" name="mobile" placeholder="موبایل" class="text-left"  />

                <x-select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\arghavan\User\Models\User::$statuses as $status)
                        <option value="{{ $status }}">
                            @lang($status)
                        </option>
                    @endforeach
                </x-select>
                <x-file placeholder="آپلود بنر کاربر" name="image"/>
                <x-input type="password" name="password" placeholder="کلمه عبور جدید"  />
                <x-input type="password" name="password_confirmation" placeholder="تکرار کلمه عبور" />
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>
                <br>
                <button class="btn btn-webamooz_net">ایجاد کاربر</button>
            </form>
        </div>
    </div>
    </div>
@endsection
