@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('brands.index') }}" title="مدل ها">مدل ها</a></li>
    <li><a href="#" title="ویرایش مدل">ویرایش مدل</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">بروزرسانی مدل</p>
            <form action="{{ route('models.update', $model->id) }}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="name"  placeholder="نام مدل" class="text" value="{{ $model->name }}" />
                <x-input type="text" name="slug"  placeholder="نام انگلیسی" class="text" value="{{ $model->slug }}" />
                <p class="box__title margin-bottom-15">وضعیت نمایش</p>
                <select name="status" id="status">
                    <option value="1" {{ $model->status==1 ? "selected" : "" }}>فعال</option>
                    <option value="0" {{ $model->status==0 ? "selected" : "" }}>غیرفعال</option>
                </select>

                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
