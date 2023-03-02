@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('orders.index') }}" title="سفارش ها">سفارش ها</a></li>
@endsection
@section('content')
    <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
        <p class="box__title">جزئیات</p>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام محصول</th>
                    <th>تصویر محصول</th>
                    <th>تعداد سفارش</th>
                    <th>مبلغ</th>
                    <th>تخفیف</th>
                    <th>وزن</th>
                </tr>
                </thead>
                <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($orders as $order)
                    <tr role="row" class="">
                        <td><a href="">{{ $i++ }}</a></td>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{ $order->product->image->thumb }}" width="80"></td>
                        <td>{{ $order->numbers }}</td>
                        <td>{{ number_format($order->price) }} تومان</td>
                        <td>{{ number_format($order->discount) }} تومان </td>
                        <td>{{ $order->weight }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection

