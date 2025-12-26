<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - @yield('title')</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <div class="nav-links">
                <a href="/">🏠 Home</a>
                <a href="/books">📚 Books</a>
                <a href="/members">👥 Members</a>
                <a href="/borrowings">📋 Borrowings</a>
            </div>

            <div class="user-info">
                @auth
                    <span>Welcome, <strong>{{ auth()->user()->name }}</strong></span>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">✗ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
