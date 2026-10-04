@extends('admin.layout')
@section('title', 'Message from '.$message->name)
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">CONTACT MESSAGE</p><h1>{{ $message->subject }}</h1></div><a class="text-link" href="{{ route('admin.messages.index') }}">← Inbox</a></div>
<dl class="message-details"><dt>From</dt><dd>{{ $message->name }} &lt;{{ $message->email }}&gt;</dd><dt>Type</dt><dd>{{ \Illuminate\Support\Str::headline($message->inquiry_type) }}</dd><dt>Received</dt><dd>{{ $message->created_at->format('Y-m-d H:i') }}</dd><dt>Message</dt><dd class="message-body">{{ $message->message }}</dd></dl>
<div class="admin-form-actions"><a class="button" href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}">Reply by email ↗</a><form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button type="submit" class="admin-delete">Delete</button></form></div>
@endsection
