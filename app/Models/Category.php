<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Blameable;

    protected $fillable = [
        'category',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
