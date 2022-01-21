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

    static public function stock($id){
        $qRes = Book::find($id);
        return $qRes->stock;
    }

    static public function increase($id){
        $stock = self::stock($id);
        $stock++;

        Book::find($id)->update([
            'stock' => $stock
        ]);
    }

    static public function decrease($id){
        $stock = self::stock($id);
        $stock--;

        Book::find($id)->update([
            'stock' => $stock
        ]);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
