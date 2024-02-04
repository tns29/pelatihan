<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicturePost extends Model
{
    use HasFactory;

    public $table = 'picture_posts';
    public $guarded = ['id'];
    public $timestamps = false;
}
