<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Image extends Model
{
    use HasFactory;

    // One to Many relationship with Comment
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc'); // Order by id desc
    }

    // One to Many relationship with Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Belongs to relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
