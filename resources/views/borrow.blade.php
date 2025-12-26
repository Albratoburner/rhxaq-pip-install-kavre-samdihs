@extends('layout')

@section('title', 'Borrow Book')

@section('content')
<h1>Borrow Book</h1>

@if(isset($book))
    <h2>Book: {{ $book->title }} by {{ $book->author }}</h2>
    <p>Available Copies: {{ $book->available_copies }}</p>
@endif

<form action="/borrowings" method="POST">
    @csrf

    <div>
        <label>Select Book:</label><br>
        <select name="book_id" required>
            <option value="">-- Select a book --</option>
            @foreach($books as $b)
                <option value="{{ $b->id }}" {{ isset($book) && $book->id == $b->id ? 'selected' : '' }}>
                    {{ $b->title }} - {{ $b->author }} ({{ $b->available_copies }} available)
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Select Member:</label><br>
        <select name="member_id" required>
            <option value="">-- Select a member --</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}">
                    {{ $member->name }} ({{ $member->membership_id }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Borrowed Date:</label><br>
        <input type="date" name="borrowed_date" value="{{ date('Y-m-d') }}" required>
    </div>

    <div>
        <label>Due Date:</label><br>
        <input type="date" name="due_date" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
    </div>

    <button type="submit">Borrow Book</button>
</form>

<p><a href="/books">← Back to Books</a></p>
@endsection
