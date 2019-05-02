<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminOfTheGroup extends Model
{
    //
    protected $table = 'admin_of_the_group';
    public function GetAdminInfo()
    {
        return $this->belongsTo('App\User','admin_id' , 'id');
    }
}
