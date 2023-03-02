@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('products.index') }}" title="محصولات">محصولات</a></li>
    <li><a href="#" title="ایجاد ویژگی">ایجاد ویژگی</a></li>
@endsection

@section('content')

    <form action="{{ route('attribute.store') }}" class="padding-30" method="post">
        @csrf
        <div class="d-flex multi-text">
            <input type="text" class="text mlg-15 w-30" name="name" placeholder="نام ویژگی"  required />
            <input type="text" class="text mlg-15 w-30" name="value" placeholder="مقدار ویژگی" required />
            <input type="hidden" name="id_product" value="{{ $product->id }}">
            {{--            <button class="btn btn-webamooz_net m-auto mt-2 ">افزودن</button>--}}
            <button class="btn-add btn-webamooz_net">ایجاد ویژگی</button>
        </div>
    </form>

    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">ویژگی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>نام ویژگی</th>
                        <th>مقدار ویژگی</th>
                        <th>نام محصول</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $attribute)
                        <tr role="row" class="">
                            <td>{{ $attribute->id }}</td>
                            <td>{{ $attribute->attribute }}</td>
                            <td>{{ $attribute->value }}</td>
                            <td>{{ $attribute->product->name }}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('attribute.destroy',$attribute->id) }}')"
                                   class="item-delete mlg-15" title="حذف"></a>


                                <a href="{{ route('attribute.edit',$attribute->id) }}" class="item-edit mlg-15 " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $attributes->links() !!}
            </div>
        </div>
    </div>

@endsection

