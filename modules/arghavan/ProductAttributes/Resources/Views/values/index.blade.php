@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="#" title="مقادیر ویژگی ها">مقادیر ویژگی ها</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">مقادیر ویژگی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>مقدار ویژگی</th>
                        <th>ویژگی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($values as $value)
                        <tr role="row" class="">
                            <td><a href="">{{ $value->id }}</a></td>
                            <td><a href="">{{ $value->title }}</a></td>
                            <td><a href="">{{ $value->attribute->name }}</a></td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('values.destroy',$value->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('values.edit',$value->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('Values::values.create')
        </div>
    </div>
@endsection
