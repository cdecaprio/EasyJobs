<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'description', 'salary', 'image', 'age', 'category', 'status', 'created_at', 'updated_at', 'user_id'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return Storage::url('public/images/' . $this->image);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
