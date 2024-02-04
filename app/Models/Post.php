<?php

namespace App\Models;

use App\Models\PicturePost;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    public $primaryKey = 'id';
    public $guarded = ['id'];
    public $timestamps = false;

    /**
     * Get all of the picturePost for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function picturePost(): HasMany
    {
        return $this->hasMany(PicturePost::class, 'post_id', 'id');
    }

}
