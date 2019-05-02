<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    protected $table = 'groups';
    public function SchoolsOfTheGroup()
    {
        return $this->HasMany('App\SchoolOfTheGroup','group_id','id' );
    }
}
