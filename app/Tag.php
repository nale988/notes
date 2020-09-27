<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{
    protected $fillable=[
        'tag',
    ];

    public function notes(){
        if(Auth::check()){
            $user_id = Auth::id();
            return $this->belongsToMany('App\Note', 'tag_connections')->where('user_id', $user_id)->orderBy('title');
        } else {
            return $this->belongsToMany('App\Note', 'tag_connections')->where('user_id', 0)->orderBy('title');
        };
    }
}
