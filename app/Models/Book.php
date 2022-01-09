<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'book',
        'summary',
        'cover',
        'stock',
        'author_id',
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
