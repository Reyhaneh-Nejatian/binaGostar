<div class="w-100 mlg-15">
    <input name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'text w-100']) }}
        value="{{ old($name) }}">
    <x-validation-error field='{{ $name }}'/>
</div>
