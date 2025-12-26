@extends('layout')

@section('title', 'Members')

@section('content')
<h1>Library Members</h1>

<h2>Register New Member</h2>
<form action="/members" method="POST">
    @csrf
    <div>
        <label>Name:</label><br>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Membership ID:</label><br>
        <input type="text" name="membership_id" required>
    </div>
    <button type="submit">Register Member</button>
</form>

<h2>Registered Members</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Membership ID</th>
            <th>Max Borrows</th>
            <th>Active Borrows</th>
        </tr>
    </thead>
    <tbody>
        @forelse($members as $member)
        <tr>
            <td>{{ $member->id }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->membership_id }}</td>
            <td>{{ $member->max_borrows }}</td>
            <td>{{ $member->borrowings->where('status', 'borrowed')->count() }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No members registered</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
