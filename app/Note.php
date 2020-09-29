<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    protected $fillable=[
        'user_id',
        'title',
        'note',
        'language',
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'tag_connections');
    }
}
