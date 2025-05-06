<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    protected $fillable = ['name', 'phone', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
