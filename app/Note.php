<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable=[
        'user_id',
        'title',
        'note',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
}
