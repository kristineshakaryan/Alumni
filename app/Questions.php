<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $table = 'questions';
    const input = 1;
    const select = 2;
    const checkbox = 3;
    const radio = 4;
    public function GetAnswer()
    {
        return $this->HasMany('App\Answer','question_id' );
    }
}
