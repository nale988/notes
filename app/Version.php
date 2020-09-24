<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable=[
        'note_id',
        'title',
        'note',
        'category_id',
        'version'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'tag_connections','note_id', 'note_id');
    }
}
