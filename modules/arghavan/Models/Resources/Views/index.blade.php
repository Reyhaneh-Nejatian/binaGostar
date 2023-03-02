@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('models.index') }}" title="مدل ها">مدل ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">مدل ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام مدل</th>
                        <th>نام انگلیسی</th>
                        <th>وضعیت نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($models as $model)
                        <tr role="row" class="">
                            <td><a href="">{{ $model->id }}</a></td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->slug }}</td>
                            <td>{{ $model->status }}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('models.destroy', $model->id) }}')" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('models.edit',  $model->id) }}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {!! $models->links() !!}
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('Model::create')
        </div>
    </div>
@endsection
