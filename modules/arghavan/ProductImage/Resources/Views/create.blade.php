<p class="box__title">ایجاد تصویر جدید</p>
<form action="{{ route('images.store') }}" method="post" class="padding-30" enctype="multipart/form-data">
    @csrf
    <x-input type="file" name="image" required placeholder="تصویر" class="text" />
    <input type="hidden" name="id_product" value="{{ $product->id }}">
    <p class="box__title margin-bottom-15">وضعیت نمایش</p>
    <select name="status" id="status">
        <option value="1" selected>فعال</option>
        <option value="0" >غیرفعال</option>
    </select>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
