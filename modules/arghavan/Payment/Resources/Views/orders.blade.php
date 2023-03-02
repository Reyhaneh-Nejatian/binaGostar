@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('orders.index') }}" title="سفارش ها">سفارش ها</a></li>
@endsection
@section('content')

    <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">سفارش ها</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل شفارش دهنده</th>
                    <th>مبلغ (تومان)</th>
                    <th>آدرس سفارش دهنده</th>
                    <th>هزینه ارسال</th>
                    <th>وضعیت سفارش</th>
                    <th>جزئیات سفارش</th>
                    <th>ثبت کد پیگیری</th>
                    <th>تغییر وضعیت سفارش</th>
                </tr>
                </thead>
                <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($orders as $order)

                    <tr role="row" class="">
                        <td><a href="">{{ $i++ }}</a></td>
                        <td>{{ $order->buyer->name }}</td>
                        <td>{{ $order->buyer->email }}</td>
                        <td>{{ number_format($order->priceFinal) }}</td>
                        <td>شهر : {{ $order->address->city->name }} - {{ $order->address->address }}</td>
                        <td>{{ number_format($order->priceSend) }} تومان </td>
                        <td class="status text-success">@lang($order->status)</td>
                        <td><a href="{{ route('orderDetails',$order->id) }}" class="item-eye mlg-15"></a></td>
                        <td><a href="{{ route('payment.code',$order->id) }}" class="item-add mlg-15"></a></td>
                        <td>
                            <a href="" onclick="updatePaymentStatus(event,'{{ route('order.posted',$order->id) }}',
                                'آیا از ارسال سفارش اطمینان دارید؟' , 'ارسال شده')"
                               class="item-posted mlg-15" title="ارسال شده"></a>

                            <a href="" onclick="updatePaymentStatus(event,'{{ route('order.preparing',$order->id) }}',
                                'آیا در حال آماده سازی سفارش هستید؟' , 'در حال آماده سازی')"
                               class="item-preparing mlg-15" title="در حال آماده سازی"></a>

                            <a href="" onclick="updatePaymentStatus(event,'{{ route('order.delivered',$order->id) }}',
                                'آیا سفارش تحویل داده شده؟' , 'تحویل داده شده')"
                               class="item-delivered mlg-15" title="تحویل داده شده"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $orders->links() !!}
        </div>
    </div>
    </div>
@endsection

