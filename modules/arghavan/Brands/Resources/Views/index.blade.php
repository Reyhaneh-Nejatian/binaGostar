@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('brands.index') }}" title="برند ها">برند ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">برند ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>عکس</th>
                        <th>نام برند</th>
                        <th>وضعیت نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr role="row" class="">
                            <td><a href="">{{ $brand->id }}</a></td>
                            <td width="80"><img src="{{ $brand->media->thumb }}" alt="" width="80"></td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->status }}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('brands.destroy', $brand->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('brands.edit',  $brand->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {!! $brands->links() !!}
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('Brand::create')
        </div>
    </div>
@endsection
