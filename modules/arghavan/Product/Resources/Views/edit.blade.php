@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('products.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ویرایش محصول">ویرایش محصول</a></li>
@endsection

@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ویرایش محصول</p>
            <form action="{{ route('products.update',$product->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input name="name" placeholder="نام محصول" type="text" value="{{ $product->name }}" required/>

                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" name="priority" placeholder="ردیف محصول" value="{{ $product->priority }}" />
                    <x-input type="text" placeholder="قیمت (تومان)" name="price" class="text-left" value="{{ $product->price }}" required />
                    <x-input type="text" placeholder="تخفیف (تومان)" name="priceOff" class="text-left" value="{{ $product->priceOff }}" />
                </div>

                <div class="d-flex multi-text">
                    <x-input type="text" placeholder="وزن محصول (گرم)" name="weight" class="text-left" value="{{ $product->weight }}" required />
                    <x-input type="number" placeholder="تعداد موجودی" name="numbers" class="text-left" value="{{ $product->numbers }}" required />
                </div>
                {{--                <x-tag-select name="tags"/>--}}

                <x-select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}"
                                @if($category->id == $product->category_id) selected @endif >
                            {{ $category->title }}
                        </option>
                    @endforeach
                </x-select>

                <x-select name="brand_id">
                    <option value="">برندها</option>
                    @foreach($brands  as $brand)
                        <option value="{{ $brand->id }}"
                                @if($brand->id == $product->brand_id) selected @endif >
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </x-select>

                <x-select name="model_id">
                    <option value="">مدل ها</option>
                    @foreach($models  as $model)
                        <option value="{{ $model->id }}"
                                @if($model->id == $product->model_id) selected @endif >
                            {{ $model->name }}
                        </option>
                    @endforeach
                </x-select>


                <x-file placeholder="تصویر محصول" name="image" :value="$product->image" />


                <x-input type="text" name="description" placeholder="خلاصه معرفی محصول" value="{{ $product->description }}" required />

                <x-text-area placeholder="معرفی کامل محصول" value="{{ $product->body }}" name="body" />

                <div class="form-group">
                    <label for="typeSend" class="col-lg-2">پست پیشتاز ؟</label>
                    <div class="col-lg-5">
                        <input name="typeSend" type="checkbox"  @if($product->post == 1) checked @endif  class="typeSendSwitch" />
                    </div>
                </div>

                <br>
                <button class="btn btn-webamooz_net">ویرایش محصول</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
