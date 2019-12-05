<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content', 'user_id', 'country', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
