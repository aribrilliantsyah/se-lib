<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BlameableObserver
{
    function __construct()
    {
        $this->user_id = Auth::check() ? Auth::user()->id: 1;    
    }

    public function creating(Model $model)
    {
        $model->created_by = $this->user_id;
        $model->updated_by = $this->user_id;
    }

    public function updating(Model $model)
    {
        $model->updated_by = $this->user_id;
    } 
}
