<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Member extends Model
{
    use HasFactory;
    use Blameable;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function generateCodeMember(){
        $sql = "SHOW TABLE status LIKE 'members';";
        $query = DB::select($sql);     
        $num =isset($query) ? $query[0]->Auto_increment : 0;
        return 'MBR-'.sprintf("%04d",$num+1);
    }
}
