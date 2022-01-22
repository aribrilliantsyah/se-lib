<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use Blameable;

    protected $fillable = [
        'author'
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }

}
