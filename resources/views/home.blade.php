@extends('layout')

@section('title', 'Dashboard')

@section('content')
<h1>📚 Library Management System</h1>

<h2>System Overview</h2>
<div class="card-grid">
    <div class="card">
        <h3>{{ $totalBooks }}</h3>
        <p>Total Books</p>
        <a href="/books">View Books →</a>
    </div>
    <div class="card">
        <h3>{{ $totalMembers }}</h3>
        <p>Total Members</p>
        <a href="/members">View Members →</a>
    </div>
    <div class="card">
        <h3>{{ $activeBorrowings }}</h3>
        <p>Active Borrowings</p>
        <a href="/borrowings">View Borrowings →</a>
    </div>
</div>

<h2>Quick Actions</h2>
<div class="quick-actions">
    <a href="/books"><button>➕ Add New Book</button></a>
    <a href="/members"><button class="btn-secondary">➕ Register Member</button></a>
    <a href="/borrow"><button class="btn-secondary">📖 Borrow Book</button></a>
</div>
@endsection
