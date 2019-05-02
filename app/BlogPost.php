<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //
    protected $table = 'blog_post';
    const status_inactive = 0;
    const status_active = 1;
}
