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

    public function generateCodeMember(){
        $sql = "SELECT nextval('members_id_seq')";
        $query = DB::select($sql);        
        $num =isset($query) ? $query[0]->nextval : 0;
        return 'MBR-'.sprintf("%04d",$num+1);
    }
}
