@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('orders.index') }}" title="سفارش ها">سفارش ها</a></li>
    <li><a href="#" title="ویرایش کد پیگیری">ویرایش کد پیگیری</a></li>
@endsection

@section('content')

    <div class="row no-gutters  ">
        <div class="col-10 bg-white">
            <p class="box__title">ویرایش کد </p>

            <form action="{{ route('code.update',$code->id) }}" class="padding-30" method="post">
                @csrf
                @method('patch')
                <div class="d-flex multi-text">
                    <input type="text" class="text mlg-15 w-30" name="code" placeholder="کد پیگیری" value="{{ $code->code }}"  required />
                    @error("code")
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="hidden" name="orderId" value="{{ $code->order_id }}">
                    <button class="btn-add btn-webamooz_net">ویرایش کد</button>
                </div>
            </form>

        </div>
    </div>


@endsection

