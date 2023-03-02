@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('orders.index') }}" title="سفارش ها">سفارش ها</a></li>
    <li><a href="#" title="ایجاد کد پیگیری">ایجاد کد پیگیری</a></li>
@endsection

@section('content')

    <form action="{{ route('code.store') }}" class="padding-30" method="post">
        @csrf
        <div class="d-flex multi-text">
            <input type="text" class="text mlg-15 w-30" name="code" placeholder="کد پیگیری"  required />
            <input type="hidden" name="orderId" value="{{ $orderId }}">
            <button class="btn-add btn-webamooz_net">ایجاد کد</button>
        </div>
    </form>

    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کد</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>کد پیگیری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($codes as $code)
                        <tr role="row" class="">
                            <td>{{ $i++ }}</td>
                            <td>{{ $code->code }}</td>
                            <td>
                                <a href="" onclick="deleteItem(event, '{{ route('code.destroy',$code->id) }}')"
                                   class="item-delete mlg-15" title="حذف"></a>

                                <a href="{{ route('code.edit',$code->id) }}" class="item-edit mlg-15 " title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

