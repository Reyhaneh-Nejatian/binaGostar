@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('brands.index') }}" title="برند ها">برند ها</a></li>
    <li><a href="#" title="ویرایش برند">ویرایش برند</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">بروزرسانی برند</p>
            <form action="{{ route('brands.update', $brand->id) }}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <img src="{{ $brand->media->thumb }}" alt="" width="80">
                <x-input type="file" name="image" placeholder="تصویر" class="text" />
                <x-input type="text" name="name"  placeholder="نام برند" class="text" value="{{ $brand->name }}" />
                <p class="box__title margin-bottom-15">وضعیت نمایش</p>
                <select name="status" id="status">
                    <option value="1" {{ $brand->status==1 ? "selected" : "" }}>فعال</option>
                    <option value="0" {{ $brand->status==0 ? "selected" : "" }}>غیرفعال</option>
                </select>

                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
