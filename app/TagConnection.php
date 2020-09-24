<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagConnection extends Model
{
    protected $fillable=[
        'note_id',
        'tag_id'
    ];
}
