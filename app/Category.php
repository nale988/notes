<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable=[
        'description'
    ];

    public function notes(){
        if(Auth::check()){
            $user_id = Auth::id();
            return $this->hasMany('App\Note', 'category_id', 'id')->where('user_id', $user_id);
        } else {
            return $this->hasMany('App\Note', 'category_id', 'id');
        };
    }
}
