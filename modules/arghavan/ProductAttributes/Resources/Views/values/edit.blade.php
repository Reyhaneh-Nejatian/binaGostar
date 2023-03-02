@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{ route('values.index') }}" title="مقدار ویژگی ها">مقدار ویژگی ها</a></li>
    <li><a href="#" title="ویرایش مقدار ویژگی ها">ویرایش مقدار ویژگی ها</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-6 bg-white">
            <p class="box__title">ویرایش مقدار ویژگی جدید </p>
            <form action="{{ route('values.update',$value->id) }}" method="post" class="padding-30">
                @csrf
                @method('patch')
                <select name="attribute" id="type">
                    <option value="">انتخاب ویژگی</option>
                    @foreach($attributes as $attribute)
                        <option value="{{ $attribute->id }}" @if($attribute->id == $value->attribute_id) selected @endif >{{ $attribute->name }}</option>
                    @endforeach
                </select>
                @error("attribute")
                <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                @enderror

                <input type="text" name="title" required placeholder="عنوان" class="text" value="{{ $value->title }}">
                @error("title")
                <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
                @enderror

                <hr>
                <button class="btn btn-webamooz_net mt-2">ویرایش مقدار</button>
            </form>
        </div>
    </div>
@endsection

