<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    //Belongs to relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Belongs to relationship with Image
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    // Get the likes of the image
    public static function getLikes($image_id)
    {
        return Like::where('image_id', $image_id)->count();
    }

    // Get the comments of the image
    public static function getComments($image_id)
    {
        return Comment::where('image_id', $image_id)->count();
    }
}
