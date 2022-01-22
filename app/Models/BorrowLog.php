<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    use HasFactory;
    use Blameable;

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
    
    public function user_create(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function user_update(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
