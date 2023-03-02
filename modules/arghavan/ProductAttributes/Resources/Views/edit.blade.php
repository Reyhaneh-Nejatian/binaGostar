@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('products.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ویرایش ویژگی">ویرایش ویژگی</a></li>
@endsection

@section('content')

    <div class="row no-gutters  ">
        <div class="col-10 bg-white">
            <p class="box__title">ویرایش ویژگی </p>

            <form action="{{ route('attribute.update',$attribute->id) }}" class="padding-30" method="post">
                @csrf
                @method('patch')
                <div class="d-flex multi-text">
                    <input type="text" class="text mlg-15 w-30" name="name" placeholder="نام ویژگی" value="{{ $attribute->attribute }}"  required />
                    @error("name")
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="text" class="text mlg-15 w-30" name="value" placeholder="مقدار ویژگی" value="{{ $attribute->value }}" required />
                    @error("value")
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="hidden" name="id_product" value="{{ $attribute->product_id }}">
                    <button class="btn-add btn-webamooz_net">ویرایش ویژگی</button>
                </div>
            </form>

        </div>
    </div>


@endsection

