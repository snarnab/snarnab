@extends('layouts.app')
@section('title', $project->title_en)
@section('description', $project->summary_en)
@section('content')
<article class="container project-detail-page">
    <a class="text-link" href="{{ route('projects.index') }}">← All projects</a>
    <p class="eyebrow">{{ $project->organization ?: strtoupper($project->category) }}{{ $project->development_year ? ' · '.$project->development_year : '' }}</p>
    <h1>{{ $project->title_en }}</h1>
    <p class="page-intro">{{ $project->summary_en }}</p>
    <div class="project-tech">@foreach($project->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div>
    @if($project->cover_path)
        <a class="project-preview-link" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" target="_blank" rel="noopener noreferrer" aria-label="Open full-size preview of {{ $project->title_en }}">
            <img class="project-detail-cover" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" alt="{{ $project->title_en }}" loading="lazy">
            <span>View full-size screenshot ↗</span>
        </a>
    @endif
    <div class="project-detail-actions">@if($project->live_url)<a class="button" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">Visit live system ↗</a>@endif @if($project->source_url)<a class="button secondary" href="{{ $project->source_url }}" target="_blank" rel="noopener noreferrer">View source code ↗</a>@endif</div>
    <div class="project-case-study">
        @if($project->slug === 'npos-inventory-management')
            <section><h2>Inventory &amp; sales</h2><ul><li>Product catalogue and inventory management</li><li>Create POS sales</li><li>Total orders and order summaries</li><li>Full memo search</li><li>Negative-stock alerts and reports</li><li>Daily order and items-sold summaries</li><li>Top-selling products over the last seven days</li></ul></section>
            <section><h2>Business &amp; shipment management</h2><ul><li>Customer and location management</li><li>Expense and profit sections</li><li>Delivery profit and organic profit reporting</li><li>Lend section</li><li>Pre-order hubs and UK shipment creation</li><li>Open, in-transit and previous shipment views</li><li>Manager-wise monthly delivery summary</li><li>Notifications and admin access</li></ul></section>
        @endif
        @if($project->slug === 'prottasha-school-management')
            <section><h2>Attendance &amp; guardian communication</h2><ul><li>Fingerprint-based attendance management</li><li>Student arrival and departure records</li><li>Student identity and attendance time display on a TV screen</li><li>Guardian arrival and departure SMS notifications</li><li>Public attendance demonstration and display preview</li></ul></section>
            <section><h2>School administration</h2><ul><li>Student management</li><li>Class and routine management</li><li>Examination and result management</li><li>Account access for school operations</li></ul></section>
        @endif
        @if($project->slug === 'dailylife-task-management')
            <section><h2>Tasks, teams &amp; reminders</h2><ul><li>Create teams and manage group tasks</li><li>Personal tasks and to-do lists</li><li>Telegram task notifications at scheduled times</li><li>Due dates, urgent/high-priority labels and task tags</li><li>My Day view for overdue, due-today and upcoming tasks</li><li>Quick add and search</li><li>Team progress and personal/group task summaries</li></ul></section>
            <section><h2>Personal planning &amp; workspace</h2><ul><li>Calendar and upcoming Google Calendar events</li><li>Meetings</li><li>Birthdays and contacts</li><li>Notes</li><li>Audio section</li><li>My Files</li><li>Notifications and settings</li><li>App download section and light/dark/system themes</li></ul></section>
            <section><h2>Progress &amp; administration</h2><ul><li>Daily completion chart for the last 14 days</li><li>Pending, overdue, high-priority and completed task totals</li><li>Weekly completion summary</li><li>All-time task creation and completion statistics</li><li>Admin panel</li><li>Google account sign-in</li></ul></section>
        @endif
        @if($project->slug === 'ai-trading-dashboard')
            <section><h2>Market analysis &amp; signals</h2><ul><li>AI-assisted chart analysis</li><li>Multi-symbol M15 scanning with Rule Engine V2</li><li>Buy, sell and no-trade setup states</li><li>A/A+ setup grading</li><li>Entry prices, stop-loss and two take-profit targets</li><li>Signal timestamps and symbol detail views</li></ul></section>
            <section><h2>Monitoring &amp; notifications</h2><ul><li>Website signal notifications</li><li>Telegram group alerts</li><li>Active trade panel with running trade status</li><li>Current prices and live profit/loss display</li><li>Overview of symbols, running trades and buy/sell setups</li><li>History, signals, statistics and performance views</li><li>Per-symbol win-rate display and settings navigation</li></ul></section>
        @endif
        @if($project->slug === 'lyrics-notebook')
            <section><h2>Song library &amp; organisation</h2><ul><li>Save song lyrics by category</li><li>Add new songs and manage collections</li><li>Search the song library</li><li>Keep a favourites collection</li><li>Trash section for removed songs</li><li>Library summaries for total songs, keyed and unkeyed songs, and major/minor keys</li></ul></section>
            <section><h2>Music categories</h2><ul><li>Patriotic songs</li><li>Nazrul Sangeet</li><li>Pancha Kabi songs</li><li>Modern Bengali songs</li><li>Manna Dey</li><li>Rabindra Sangeet</li><li>Folk songs</li><li>Hindi songs</li><li>Hemanta Mukhopadhyay</li></ul></section>
            <section><h2>Practice &amp; personal workspace</h2><ul><li>Download and export lyrics</li><li>Print lyrics for practice and performance</li><li>Language selection</li><li>Light/dark theme control</li><li>Personal collection and account access</li></ul></section>
        @endif
        @if($project->slug === 'connect-cse-ruet')
            <section><h2>Academic tools</h2><ul><li>Class material management</li><li>Lab booking</li><li>Holiday management</li><li>Class routines and schedule publishing</li><li>Project &amp; thesis management</li><li>Today’s classes with period, time, course, teacher, room, section and class type</li><li>Weekly calendar export (.ics) and full routine view</li></ul></section>
            <section><h2>Department management</h2><ul><li>Student information</li><li>Advisor management and My Advisory</li><li>Disciplinary records</li><li>News &amp; events</li><li>Breaking news announcements</li><li>Complaint forms and complaint management</li><li>Leave management</li><li>Accounts module</li></ul></section>
            <section><h2>Administration &amp; dashboard</h2><ul><li>User account management</li><li>Roles &amp; permissions</li><li>Audit logs for system activity</li><li>Notifications and profile access</li><li>Student, teacher, course and pending complaint summaries</li><li>Quick actions for users, permissions, schedules and announcements</li></ul></section>
        @endif
        @foreach(['problem' => 'The need', 'solution' => 'The solution', 'outcome' => 'The outcome'] as $key => $label)
            @if($project->getAttribute($key.'_en'))<section><h2>{{ $label }}</h2><p>{{ $project->getAttribute($key.'_en') }}</p></section>@endif
        @endforeach
    </div>
    @if($project->images->isNotEmpty())<div class="photo-gallery">@foreach($project->images as $image)<figure><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image_path) }}" alt="{{ $image->alt_en ?: $project->title_en }}" loading="lazy"></figure>@endforeach</div>@endif
</article>
@endsection
