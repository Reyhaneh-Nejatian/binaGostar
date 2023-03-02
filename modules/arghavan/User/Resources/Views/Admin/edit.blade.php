@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection

@section('content')
    <div class="row no-gutters margin-bottom-20">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>
            <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input name="name" placeholder="نام کاربر" type="text" value="{{ $user->name }}" required/>
                <x-input type="text" name="email" placeholder="ایمیل" value="{{ $user->email }}" class="text-left" required />
                <x-input type="text" name="username" placeholder="نام کاربری" value="{{ $user->username }}" class="text-left"  />
                <x-input type="text" name="mobile" placeholder="موبایل" value="{{ $user->mobile }}" class="text-left"  />

                <x-select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\arghavan\User\Models\User::$statuses as $status)
                        <option value="{{ $status }}" @if($status == $user->status) selected @endif>
                            @lang($status)
                        </option>
                    @endforeach
                </x-select>
                <x-select name="role" >
                    <option value="">یک نقش کاربری انتخاب کنید</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>@lang($role->name)</option>
                    @endforeach
{{--                    @foreach($roles as $role)--}}
{{--                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>@lang($role->name)</option>--}}
{{--                    @endforeach--}}
                </x-select>

                <x-file placeholder="آپلود بنر کاربر" name="image" :value="$user->image"/>
                <x-input type="password" name="password" placeholder="پسورد جدید" value=""  />
                <x-input type="password" name="password_confirmation" placeholder="تکرار پسورد جدید" value=""  />

                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&amp;*()</strong> باشد.</p>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی کاربر</button>
            </form>
        </div>
    </div>
    </div>
@endsection
