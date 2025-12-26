<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Exception;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'member'])->orderBy('created_at', 'desc')->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create(Request $request)
    {
        $books = Book::where('available_copies', '>', 0)->get();
        $members = Member::all();
        $book = null;

        if ($request->has('book_id')) {
            $book = Book::find($request->book_id);
        }

        return view('borrow', compact('books', 'members', 'book'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'book_id' => 'required|exists:books,id',
                'member_id' => 'required|exists:members,id',
                'borrowed_date' => 'required|date',
                'due_date' => 'required|date|after:borrowed_date'
            ]);

            DB::beginTransaction();

            $book = Book::findOrFail($validated['book_id']);
            $member = Member::findOrFail($validated['member_id']);

            // Business Rule 1: Check if book is available
            if ($book->available_copies <= 0) {
                throw new Exception('Book is not available for borrowing');
            }

            // Business Rule 2: Check member's max borrow limit
            $activeBorrows = Borrowing::where('member_id', $member->id)
                ->where('status', 'borrowed')
                ->count();

            if ($activeBorrows >= $member->max_borrows) {
                throw new Exception('Member has reached maximum borrow limit (' . $member->max_borrows . ' books)');
            }

            // Business Rule 3: Check for duplicate active borrowing (handled by unique constraint)
            $existingBorrow = Borrowing::where('book_id', $book->id)
                ->where('member_id', $member->id)
                ->where('status', 'borrowed')
                ->first();

            if ($existingBorrow) {
                throw new Exception('Member has already borrowed this book and not returned it yet');
            }

            // Create borrowing record
            $validated['status'] = 'borrowed';
            Borrowing::create($validated);

            // Decrease available copies
            $book->decrement('available_copies');

            DB::commit();

            return redirect('/borrowings')->with('success', 'Book borrowed successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/borrow')->with('error', 'Error borrowing book: ' . $e->getMessage());
        }
    }

    public function return($id)
    {
        try {
            DB::beginTransaction();

            $borrowing = Borrowing::findOrFail($id);

            if ($borrowing->status == 'returned') {
                throw new Exception('Book has already been returned');
            }

            // Update borrowing record
            $borrowing->status = 'returned';
            $borrowing->returned_date = now();
            $borrowing->save();

            // Increase available copies
            $book = $borrowing->book;
            $book->increment('available_copies');

            DB::commit();

            return redirect('/borrowings')->with('success', 'Book returned successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/borrowings')->with('error', 'Error returning book: ' . $e->getMessage());
        }
    }
}
