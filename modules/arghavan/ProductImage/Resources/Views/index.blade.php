@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('products.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ایجاد تصویر">ایجاد تصویر</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">تصویر ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>تصویر محصول</th>
                        <th>وضعیت نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $image)
                        <tr role="row" class="">
                            <td><a href="">{{ $image->id }}</a></td>
                            <td width="80"><img src="{{ $image->media->thumb }}" alt="" width="80"></td>
                            <td>{{ $image->status }}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('images.destroy', $image->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('images.edit',  $image->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {!! $images->links() !!}
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('ProductImages::create')
        </div>
    </div>
@endsection
