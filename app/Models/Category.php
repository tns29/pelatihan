<?php

namespace App\Models;

use App\Models\Training;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // public $with = ['categories'];
    public $guarded = ['id'];
    public $timestamps = false;

    // public function training(): HasMany
    // {
    //     return $this->hasMany(Training::class, 'category_id', 'id');
    // }
}
