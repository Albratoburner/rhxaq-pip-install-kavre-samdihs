<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'membership_id',
        'max_borrows'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
