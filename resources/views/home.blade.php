@extends('layout')

@section('title', 'Home')

@section('content')
<h1>Library Management System</h1>

<h2>System Overview</h2>
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 30px 0;">
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="color: #333;">{{ $totalBooks }}</h3>
        <p>Total Books</p>
        <a href="/books">View Books</a>
    </div>
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="color: #333;">{{ $totalMembers }}</h3>
        <p>Total Members</p>
        <a href="/members">View Members</a>
    </div>
    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="color: #333;">{{ $activeBorrowings }}</h3>
        <p>Active Borrowings</p>
        <a href="/borrowings">View Borrowings</a>
    </div>
</div>

<h2>Quick Actions</h2>
<div style="margin: 20px 0;">
    <a href="/books"><button>Add New Book</button></a>
    <a href="/members"><button>Register Member</button></a>
    <a href="/borrow"><button>Borrow Book</button></a>
</div>

<h2>Business Rules Enforced</h2>
<ul style="line-height: 2;">
    <li><strong>No duplicate active borrowings:</strong> A member cannot borrow the same book twice while it's still borrowed</li>
    <li><strong>Available copies tracking:</strong> System automatically updates available copies when books are borrowed/returned</li>
    <li><strong>Unique constraints:</strong> Books have unique ISBN, members have unique email and membership ID</li>
    <li><strong>Maximum borrow limit:</strong> Members have a maximum borrow limit (default: 3 books)</li>
</ul>
@endsection
