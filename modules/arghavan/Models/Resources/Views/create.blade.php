<p class="box__title">ایجاد مدل جدید</p>
<form action="{{ route('models.store') }}" method="post" class="padding-30" enctype="multipart/form-data">
    @csrf
    <x-input type="text" name="name"  placeholder="نام مدل" class="text" />
    <x-input type="text" name="slug"  placeholder="نام انگلیسی" class="text" />
    <p class="box__title margin-bottom-15">وضعیت نمایش</p>
    <select name="status" id="status">
        <option value="1" selected>فعال</option>
        <option value="0" >غیرفعال</option>
    </select>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
