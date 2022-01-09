<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'full_name',
        'address',
        'gender',
        'photo',
        'profession',
        'user_id'
    ];

    public function borrow_logs(){
        return $this->hasMany(BorrowLog::class);
    }
}
