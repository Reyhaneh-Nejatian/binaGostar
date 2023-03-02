@extends('Dashboard::master')

@section('content')
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش سایت</p>
            <p>{{ number_format($totalSell) }} تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درآمد 30 روز گذشته</p>
            <p>{{ number_format($last30DaysTotal) }} تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درآمد امروز</p>
            <p>{{ number_format($todaysIncome) }} تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p>تعداد تراکنش های موفق امروز</p>
            <p>{{ $todaySuccessPaymentsCount }} تراکنش </p>
        </div>
    </div>
    <div class="row bg-white no-gutters font-size-13">
        <div class="title__row">
            <p>تراکنش های اخیر شما</p>
            <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
        </div>
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
        </div>
    </div>
@endsection
