@extends('admin.layout')
@section('title', $definition['title'].' · Admin')
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">CONTENT</p><h1>{{ $definition['title'] }}</h1></div><a class="button" href="{{ route('admin.resources.create', $resource) }}">Add {{ \Illuminate\Support\Str::singular($definition['title']) }}</a></div>
<div class="admin-table-wrap"><table class="admin-table"><thead><tr>@foreach($definition['columns'] as $column)<th>{{ \Illuminate\Support\Str::headline($column) }}</th>@endforeach<th>Actions</th></tr></thead><tbody>
@forelse($records as $record)
    <tr>@foreach($definition['columns'] as $column)<td>{{ data_get($record, $column) }}</td>@endforeach<td class="admin-actions"><a href="{{ route('admin.resources.edit', [$resource, $record->getKey()]) }}">Edit</a><form method="POST" action="{{ route('admin.resources.destroy', [$resource, $record->getKey()]) }}" onsubmit="return confirm('Delete this item?')">@csrf @method('DELETE')<button type="submit" class="admin-delete">Delete</button></form></td></tr>
@empty
    <tr><td colspan="{{ count($definition['columns']) + 1 }}">No entries yet.</td></tr>
@endforelse
</tbody></table></div>
{{ $records->links() }}
@endsection
