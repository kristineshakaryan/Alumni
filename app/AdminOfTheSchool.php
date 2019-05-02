<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminOfTheSchool extends Model
{
    //
    protected $table = 'admin_of_the_school';

    public function GetAdminInfo()
    {
        return $this->belongsTo('App\User','admin_id' , 'id');
    }
}
