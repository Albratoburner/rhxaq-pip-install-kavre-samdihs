<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - @yield('title')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        nav { background: #333; color: white; padding: 15px; margin: -20px -20px 20px -20px; border-radius: 8px 8px 0 0; }
        nav a { color: white; text-decoration: none; margin-right: 20px; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #333; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background: #333; color: white; }
        form { margin: 20px 0; }
        input, select, button { padding: 10px; margin: 5px 0; font-size: 14px; }
        input[type="text"], input[type="email"], input[type="date"], select { width: 100%; max-width: 400px; }
        button { background: #333; color: white; border: none; cursor: pointer; padding: 10px 20px; }
        button:hover { background: #555; }
        .alert { padding: 15px; margin: 15px 0; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; }
        .badge-borrowed { background: #ffc107; color: #000; }
        .badge-returned { background: #28a745; color: white; }
        .badge-overdue { background: #dc3545; color: white; }
        .user-info { float: right; color: white; }
        .user-info form { display: inline; }
        .user-info button { padding: 8px 15px; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/">Home</a>
            <a href="/books">Books</a>
            <a href="/members">Members</a>
            <a href="/borrowings">Borrowings</a>

            <div class="user-info">
                @auth
                    Welcome, {{ auth()->user()->name }}
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
