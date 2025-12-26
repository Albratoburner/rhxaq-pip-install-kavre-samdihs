<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'author',
        'total_copies',
        'available_copies'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
