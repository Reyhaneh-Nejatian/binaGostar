<p class="box__title">ایجاد مقدار ویژگی جدید </p>
<form action="{{ route('values.store') }}" method="post" class="padding-30">
    @csrf

    <select name="attribute" id="type">
        <option value="">انتخاب ویژگی</option>
        @foreach($attributes as $attribute)
            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
        @endforeach
    </select>
    @error("attribute")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <input type="text" name="title" required placeholder="عنوان" class="text" value="{{ old('title') }}">
    @error("title")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <hr>
    <button class="btn btn-webamooz_net mt-2">ایجاد مقدار</button>
</form>
