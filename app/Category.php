<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public function newsCat()
    {
        return $this->belongsToMany('App\News', 'mix_news_category', 'category_id', 'news_id')->withTimestamps();;
    }
}
