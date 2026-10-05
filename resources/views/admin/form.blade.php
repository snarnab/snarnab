@extends('admin.layout')
@section('title', ($entry->exists ? 'Edit ' : 'Add ').$definition['title'])
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">{{ $definition['title'] }}</p><h1>{{ $entry->exists ? 'Edit entry' : 'Add entry' }}</h1></div><a class="text-link" href="{{ route('admin.resources.index', $resource) }}">← Back to list</a></div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $entry->exists ? route('admin.resources.update', [$resource, $entry->getKey()]) : route('admin.resources.store', $resource) }}">
    @csrf
    @if($entry->exists)@method('PUT')@endif
    @foreach($definition['fields'] as $key => $field)
        @php
            $selected = old($key, $key === 'technology_ids' ? ($entry->exists ? $entry->technologies->modelKeys() : []) : $entry->getAttribute($key));
            $options = isset($field['options']) ? \App\Http\Controllers\PortfolioAdminController::options($field['options']) : [];
        @endphp
        <div class="admin-field @if($field['type'] === 'checkbox') checkbox-field @endif">
            @if($field['type'] === 'checkbox')
                <label><input type="checkbox" name="{{ $key }}" value="1" @checked((bool) $selected)> {{ $field['label'] }}</label>
            @elseif($field['type'] === 'textarea')
                <label for="{{ $key }}">{{ $field['label'] }}</label><textarea id="{{ $key }}" name="{{ $key }}" rows="4" @if($errors->has($key)) aria-invalid="true" @endif>{{ $selected }}</textarea>
            @elseif($field['type'] === 'select')
                <label for="{{ $key }}">{{ $field['label'] }}</label><select id="{{ $key }}" name="{{ $key }}"><option value="">— Select —</option>@foreach($options as $optionValue => $optionLabel)<option value="{{ $optionValue }}" @selected((string) $selected === (string) $optionValue)>{{ $optionLabel }}</option>@endforeach</select>
            @elseif($field['type'] === 'multiselect')
                <label for="{{ $key }}">{{ $field['label'] }}</label><select id="{{ $key }}" name="{{ $key }}[]" multiple size="5">@foreach($options as $optionValue => $optionLabel)<option value="{{ $optionValue }}" @selected(in_array((string) $optionValue, array_map('strval', (array) $selected), true))>{{ $optionLabel }}</option>@endforeach</select>
            @elseif($resource === 'photographs' && ! $entry->exists && $field['type'] === 'image')
                <label for="{{ $key }}">Images</label>
                <input id="{{ $key }}" name="{{ $key }}[]" type="file" accept="image/*" multiple>
                <small>Select up to 20 photos, each up to 5 MB. All photos use the category and details entered here.</small>
                @foreach($errors->get($key.'.*') as $messages)
                    @foreach($messages as $message)<small class="field-error">{{ $message }}</small>@endforeach
                @endforeach
            @else
                <label for="{{ $key }}">{{ $field['label'] }}</label><input id="{{ $key }}" name="{{ $key }}" type="{{ $field['type'] === 'image' ? 'file' : $field['type'] }}" @if($field['type'] === 'image') accept="image/*" @else value="{{ $selected }}" @endif @if($errors->has($key)) aria-invalid="true" @endif>
                @if($field['type'] === 'image' && $selected)<small>Current file: {{ $selected }}</small>@endif
            @endif
            @error($key)<small class="field-error">{{ $message }}</small>@enderror
        </div>
    @endforeach
    <div class="admin-form-actions"><button class="button" type="submit">Save changes</button><a class="text-link" href="{{ route('admin.resources.index', $resource) }}">Cancel</a></div>
</form>
@endsection
