<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;

class HomeController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();

        return view('home', compact('totalBooks', 'totalMembers', 'activeBorrowings'));
    }
}
