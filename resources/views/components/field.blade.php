@props(['name', 'label', 'type' => 'text', 'value' => null, 'labelEnglish' => null])
<div class="field">
    <label for="{{ $attributes->get('id', $name) }}" @if($labelEnglish) data-bn="{{ $label }}" data-en="{{ $labelEnglish }}" @endif>{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $attributes->get('id', $name) }}" value="{{ $type === 'password' ? '' : old($name, $value) }}" @if($errors->has($name)) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @endif {{ $attributes->except('id') }}>
    @error($name)<small class="field-error" id="{{ $attributes->get('id', $name) }}-error">{{ $message }}</small>@enderror
</div>
