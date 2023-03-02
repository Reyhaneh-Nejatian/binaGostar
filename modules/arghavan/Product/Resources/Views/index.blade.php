@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="#" title="محصولات">محصولات</a></li>
@endsection

@section('content')
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item {{ request("status") == "" ? "is-active" : "" }}" href="{{ route('products.index') }}?status=">لیست محصولات</a>
            <a class="tab__item {{ request("status") == "approved" ? "is-active" : "" }}" href="{{ route('products.index') }}?status=accepted">محصولات تایید شده</a>
            <a class="tab__item {{ request("status") == "rejected" ? "is-active" : "" }}" href="{{ route('products.index') }}?status=rejected">محصولات تایید نشده</a>
            <a class="tab__item {{ request("status") == "pending" ? "is-active" : "" }}" href="{{ route('products.index') }}?status=pending">محصولات درحال انتظار</a>
            <a href="{{ route('products.create') }}" title="ایجاد محصول جدید">ایجاد محصول جدید</a>
        </div>
    </div>
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">محصولات</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>عکس محصول</th>
                        <th>نام محصول</th>
                        <th>تعداد موجودی</th>
                        <th>قیمت</th>
                        <th>وزن</th>
                        <th>جزئیات</th>
                        <th>وضعیت تایید</th>
                        <th>افزودن ویژگی</th>
                        <th>افزودن عکس</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr role="row" class="">
                            <td><a href="">{{ $product->priority }}</a></td>
                            <td><a href="">{{ $product->id }}</a></td>
                            <td width="80"><img src="{{ $product->image->thumb }}" alt="" width="80"></td>
                            <td><a href="">{{ $product->name }}</a></td>
                            <td><a href="">{{ $product->numbers }}</a></td>
                            <td>{{ $product->price }} (تومان)</td>
                            <td>{{ $product->weight }} (گرم)</td>
                            <td>{{ $product->description }}</td>
                            <td class="confirmation_status {{ $product->confirmation_status == 'accepted' ? "text-success " : "text-error" }}">@lang($product->confirmation_status)</td>
                            <td><a href="{{ route('products.addAttribute',$product->id) }}" class="item-add mlg-15"></a></td>
                            <td><a href="{{ route('products.addImage',$product->id) }}" class="item-add mlg-15"></a></td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('products.destroy',$product->id) }}')"
                                   class="item-delete mlg-15" title="حذف"></a>

                                <a href="" onclick="updateConfirmationStatus(event,'{{ route('products.accept',$product->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                                   class="item-confirm mlg-15" title="تایید"></a>

                                <a href="" onclick="updateConfirmationStatus(event,'{{ route('products.reject',$product->id) }}',
                                    'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                                   class="item-reject mlg-15" title="رد"></a>

                                <a href="" onclick="updateConfirmationStatus(event, '{{ route('products.lock', $product->id) }}',
                                    'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                                   class="item-lock mlg-15" title="قفل کردن"></a>

                                <a href="{{ route('products.edit',$product->id) }}" class="item-edit mlg-15 " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
