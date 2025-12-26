@extends('layout')

@section('title', 'Books')

@section('content')
<h1>Library Books</h1>

<h2>Add New Book</h2>
<form action="/books" method="POST">
    @csrf
    <div>
        <label>Title:</label><br>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>ISBN:</label><br>
        <input type="text" name="isbn" required>
    </div>
    <div>
        <label>Author:</label><br>
        <input type="text" name="author" required>
    </div>
    <div>
        <label>Total Copies:</label><br>
        <input type="text" name="total_copies" value="1" required>
    </div>
    <button type="submit">Add Book</button>
</form>

<h2>Available Books</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Available / Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->available_copies }} / {{ $book->total_copies }}</td>
            <td>
                @if($book->available_copies > 0)
                    <a href="/borrow?book_id={{ $book->id }}">Borrow</a>
                @else
                    <span style="color: #999;">Not Available</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No books available</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
