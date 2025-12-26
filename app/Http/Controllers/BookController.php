<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Exception;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'isbn' => 'required|string|unique:books,isbn',
                'author' => 'required|string|max:255',
                'total_copies' => 'required|integer|min:1'
            ]);

            $validated['available_copies'] = $validated['total_copies'];

            Book::create($validated);

            return redirect('/books')->with('success', 'Book added successfully!');
        } catch (Exception $e) {
            return redirect('/books')->with('error', 'Error adding book: ' . $e->getMessage());
        }
    }
}
