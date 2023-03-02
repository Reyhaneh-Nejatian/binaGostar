@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{ route('users.index') }}" title="کاربران">کاربران</a></li>
@endsection

@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item {{ request("status") == "" ? "is-active" : "" }}" href="{{ route('users.index') }}?status=">همه کاربران</a>
            <a class="tab__item {{ request("status") == "approved" ? "is-active" : "" }}" href="{{ route('users.index') }}?status=approved">کاربران تاییده شده</a>
            <a class="tab__item {{ request("status") == "rejected" ? "is-active" : "" }}" href="{{ route('users.index') }}?status=rejected">کاربران تایید نشده</a>
            <a href="{{ route('users.create') }}" title="ایجاد کاربر جدید">ایجاد کاربر جدید</a>
        </div>
    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <div class="t-header-search">
            <form action="{{ route('users.index') }}">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی کاربر">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text" value="{{ request("email") }}" name="email"  placeholder="ایمیل">
                        <input type="text"  class="text" value="{{ request("mobile") }}" name="mobile" placeholder="شماره">
                        <input type="text"  class="text margin-bottom-20" value="{{ request("name") }}" name="name"  placeholder="نام و نام خانوادگی">
                        <button class="btn btn-webamooz_net">جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل</th>
                <th>شماره موبایل</th>
                <th>سطح کاربری</th>
                <th>تاریخ عضویت</th>
                <th>وضعیت حساب</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr role="row" class="">
                    <td><a href="">{{ $user->id }}</a></td>
                    <td><a href="">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>
                        <ul>
                            @foreach($user->roles as $userRole)
                                <li class="deleteable-list-item">@lang($userRole->name)</li>
                            @endforeach
                        </ul>
                    </td>
{{--                    <td>Jalalian::fromDateTime('yesterday');</td>--}}
                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($user->created_at)->format('H:i:s Y/m/d') }}</td>
{{--                    <td>{{ $user->created_at }}</td>--}}
                    <td class="confirmation_status">{!! $user->hasVerifiedEmail() ? "<span class='text-success'>تایید شده</span>" : "<span class='text-error'>تایید نشده</span>" !!}</td>
                    <td>
                        <a href="" onclick="deleteItem(event,'{{ route('users.destroy',$user->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('users.manualVerify', $user->id) }}',
                            'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')" class="item-confirm mlg-15" title="تایید"></a>
                        <a href="{{ route('users.edit',$user->id) }}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $users->links() !!}
    </div>

@endsection
