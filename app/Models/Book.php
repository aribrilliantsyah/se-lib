<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Book extends Model
{
    use HasFactory;
    use Blameable;

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

    public function generateCodeBook(){
        $sql = "SHOW TABLE status LIKE 'books';";
        $query = DB::select($sql);     
        $num =isset($query) ? $query[0]->Auto_increment : 0;
        return 'MBR-'.sprintf("%04d",$num+1);
    }
}
