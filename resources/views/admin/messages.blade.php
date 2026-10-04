@extends('admin.layout')
@section('title', 'Contact messages · Admin')
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">INBOX</p><h1>Contact messages</h1></div></div>
<div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>From</th><th>Subject</th><th>Type</th><th>Received</th><th>Status</th><th></th></tr></thead><tbody>
@forelse($messages as $message)
    <tr><td>{{ $message->name }}<br><small>{{ $message->email }}</small></td><td>{{ $message->subject }}</td><td>{{ \Illuminate\Support\Str::headline($message->inquiry_type) }}</td><td>{{ $message->created_at->format('Y-m-d H:i') }}</td><td>{{ $message->read_at ? 'Read' : 'Unread' }}</td><td><a href="{{ route('admin.messages.show', $message) }}">Open</a></td></tr>
@empty
    <tr><td colspan="6">No messages yet.</td></tr>
@endforelse
</tbody></table></div>
{{ $messages->links() }}
@endsection
