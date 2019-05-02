<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryOfTheUser extends Model
{
    //
    protected $table = 'category_of_the_user';

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

}
