@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('products.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ایجاد محصول">ایجاد محصول</a></li>
@endsection

@section('content')
    <div class="row no-gutters ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد محصول</p>
            <form action="{{ route('products.store') }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <x-input name="name" placeholder="نام محصول" type="text" required/>

                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" name="priority" placeholder="ردیف محصول" />
                    <x-input type="text" placeholder="قیمت (تومان)" name="price" class="text-left" required />
                    <x-input type="text" placeholder="تخفیف(تومان)" name="priceOff" class="text-left"  />
                </div>

                <div class="d-flex multi-text">
                    <x-input type="text" placeholder="وزن محصول (گرم)" name="weight" class="text-left" required />
                    <x-input type="number" placeholder="تعداد موجودی" name="numbers" class="text-left" required />
                </div>

                <select name="category_id" id="category_id"  onchange="addForm(this.value)" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}"
                                @if($category->id == old('category_id')) selected @endif >
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>

                <select name="brand_id" id="brand_id"  onchange="addForm(this.value)" required>
                    <option value="">برندها</option>
                    @foreach($brands  as $brand)
                        <option value="{{ $brand->id }}"
                                @if($brand->id == old('brand_id')) selected @endif >
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <select name="model_id" id="model_id"  onchange="addForm(this.value)" required>
                    <option value="">مدل ها</option>
                    @foreach($models  as $model)
                        <option value="{{ $model->id }}"
                                @if($model->id == old('model_id')) selected @endif >
                            {{ $model->name }}
                        </option>
                    @endforeach
                </select>

                <div class="row" id="guestDetails">

                </div>

                <x-file placeholder="تصویر محصول" name="image[]" required />


                <x-input type="text" name="description" placeholder="خلاصه معرفی محصول" required />

                <x-text-area placeholder="معرفی کامل محصول" name="body" />

                <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">پست پیشتاز ؟</label>
                    <div class="col-lg-5">
                        <input name="typeSend" type="checkbox"  checked value="1" class="typeSendSwitch" />
                    </div>
                </div>

                <br>
                <button class="btn btn-webamooz_net">ایجاد محصول</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
    <script>

        // function addForm(values) {
        //     const url = '/category/attribute/ajax/'+values ;
        //     if(values){
        //         $.get(url,{_method:"get"})
        //             .done(function (response) {
        //                 var element = document.getElementById('guestDetails');
        //                 element.innerHTML = ""; //empty
        //                 $.each(response,function (key,value){
        //                     var name = value.name;
        //                     element.innerHTML += `<div class="col-12 padding-19">
        //                        <x-input name="`+value.id+`" placeholder="`+value.name+`" type="text" required/>
        //                    </div>`;
        //                 })
        //             })
        //     }
        // }





        {{--$(document).ready(function (){--}}
        {{--    $('select[name="category_id"]').on('change',function (){--}}
        {{--        var category_id = $(this).val();--}}
        {{--        if(category_id){--}}
        {{--            $.ajax({--}}
        {{--                url:"{{ url('/category/attribute/ajax') }}/"+category_id,--}}
        {{--                type:"GET",--}}
        {{--                dataType:"json",--}}
        {{--                success:function (data){--}}
        {{--                    $.each(data,function (key,value){--}}

        {{--                        HTMLInputElement.--}}
        {{--                    });--}}
        {{--                },--}}
        {{--            });--}}
        {{--        }else{--}}
        {{--            alert('danger');--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    </script>


<script>






</script>



@endsection
