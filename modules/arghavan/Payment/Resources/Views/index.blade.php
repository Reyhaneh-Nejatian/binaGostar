@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('payments.index') }}" title="تراکنش ها">تراکنش ها</a></li>
@endsection
@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item {{ request("status") == "" ? "is-active" : "" }}" href="{{ route('payments.index') }}?status=">لیست تراکنش ها</a>
            <a class="tab__item {{ request("status") == "success" ? "is-active" : "" }}" href="{{ route('payments.index') }}?status=success">تراکنش های موفق</a>
            <a class="tab__item {{ request("status") == "fail" ? "is-active" : "" }}" href="{{ route('payments.index') }}?status=fail">تراکنش های ناموفق</a>
            <a class="tab__item {{ request("status") == "pending" ? "is-active" : "" }}" href="{{ route('payments.index') }}?status=pending">تراکنش های درحال انتظار</a>
            <a class="tab__item {{ request("status") == "canceled" ? "is-active" : "" }}" href="{{ route('payments.index') }}?status=canceled">تراکنش های لغو شده</a>
        </div>
    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <p class="margin-bottom-15">همه تراکنش ها</p>
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text" name="email" value="{{ request("email") }}"  placeholder="ایمیل">
                        <input type="text"  class="text" name="amount"  value="{{ request("amount") }}" placeholder="مبلغ به تومان">
                        <input type="text"  class="text" name="invoice_id" value="{{ request("invoice_id") }}" placeholder="شماره تراکنش">
                        <button type="submit" class="btn btn-webamooz_net" >جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">تراکنش ها</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>شماره تراکنش</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل پرداخت کننده</th>
                    <th>مبلغ (تومان)</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($payments as $payment)
                    <tr role="row" class="">
                        <td><a href="">{{ $i++ }}</a></td>
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->buyer->name }}</td>
                        <td>{{ $payment->buyer->email }}</td>
                        <td>{{ number_format($payment->amount) }}</td>
                        <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at)->format('H:i Y/m/d') }}</td>
                        <td class="@if($payment->status == \arghavan\Payment\Models\Payment::STATUS_SUCCESS) text-success @else text-error @endif">@lang($payment->status)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $payments->links() !!}
        </div>
    </div>
    </div>
@endsection

