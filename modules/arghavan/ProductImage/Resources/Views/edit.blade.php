@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('brands.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ویرایش برند">ویرایش تصویر</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">ویرایش تصویر</p>
            <form action="{{ route('images.update', $image->id) }}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <img src="{{ $image->media->thumb }}" alt="" width="80">
                <x-input type="file" name="image" placeholder="تصویر" class="text" />
                <input type="hidden" name="id_product" value="{{ $image->product_id }}">
                <p class="box__title margin-bottom-15">وضعیت نمایش</p>
                <select name="status" id="status">
                    <option value="1" {{ $image->status==1 ? "selected" : "" }}>فعال</option>
                    <option value="0" {{ $image->status==0 ? "selected" : "" }}>غیرفعال</option>
                </select>

                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
