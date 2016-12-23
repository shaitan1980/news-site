<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    //protected $fillable = ['title', 'slug', 'body', 'image', 'author_id', 'read', 'is_analitics'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'mix_news_category', 'news_id', 'category_id')->withTimestamps();;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'mix_news_tags', 'news_id', 'tag_id')->withTimestamps();;
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
