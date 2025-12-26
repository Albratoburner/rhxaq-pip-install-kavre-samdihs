@extends('layout')

@section('title', 'Borrowings')

@section('content')
<h1>Book Borrowings</h1>

<h2>All Borrowing Records</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Book</th>
            <th>Member</th>
            <th>Borrowed Date</th>
            <th>Due Date</th>
            <th>Returned Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($borrowings as $borrowing)
        <tr>
            <td>{{ $borrowing->id }}</td>
            <td>{{ $borrowing->book->title }}</td>
            <td>{{ $borrowing->member->name }}</td>
            <td>{{ $borrowing->borrowed_date->format('Y-m-d') }}</td>
            <td>{{ $borrowing->due_date->format('Y-m-d') }}</td>
            <td>{{ $borrowing->returned_date ? $borrowing->returned_date->format('Y-m-d') : '-' }}</td>
            <td>
                <span class="badge badge-{{ $borrowing->status }}">
                    {{ ucfirst($borrowing->status) }}
                </span>
            </td>
            <td>
                @if($borrowing->status == 'borrowed' || $borrowing->status == 'overdue')
                <form action="/borrowings/{{ $borrowing->id }}/return" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Return</button>
                </form>
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center;">No borrowing records</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
