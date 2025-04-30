<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $fillable = ['title', 'artist', 'song', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
