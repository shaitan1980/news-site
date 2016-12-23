<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function newsPost()
    {
        return $this->belongsTo('App\News');
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

}
