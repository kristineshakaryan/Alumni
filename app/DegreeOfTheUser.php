<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeOfTheUser extends Model
{
    //
    protected $table = 'degree_of_the_user';

    public function degree()
    {
        return $this->belongsTo('App\Degree','degree_id');
    }

}
