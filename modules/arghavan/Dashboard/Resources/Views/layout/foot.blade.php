<script src="{{ asset('Panel/js/jquery-3.4.1.min.js') }}"></script>
{{--<script src="{{ asset('js/jquery.toast.min.js') }}"></script>--}}
<script src="{{ asset('Panel/js/js.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jalalidatepicker.min.js') }}"></script>

@section('js')
    <script>
{{--        @include('Common::layout.feedbacks')--}}
    </script>

    <script>
        jalaliDatepicker.startWatch();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


@endsection
@yield('js')
