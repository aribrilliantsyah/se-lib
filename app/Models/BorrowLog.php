<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'is_returned',
        'return_estimate',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
