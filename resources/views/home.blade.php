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
@endsection
