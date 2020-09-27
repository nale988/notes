<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'note_id'
    ];

    public function notes(){
        if(Auth::check()){
            $user_id = Auth::id();
            //return $this->belongsToMany('App\Note', 'tag_connections')->where('user_id', $user_id)->orderBy('title');
            return $this -> hasOne('App\Note', 'id', 'note_id')->where('user_id', $user_id);

        } else {
            return $this -> hasOne('App\Note', 'id', 'note_id')->where('user_id', 0);
            //return $this->belongsToMany('App\Note', 'tag_connections')->where('user_id', 0)->orderBy('title');
        };
    }
}
