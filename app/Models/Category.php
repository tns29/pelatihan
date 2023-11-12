<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $timestamps = false;

    public function Training(): HasMany
    {
        return $this->hasMany(Training::class, 'category_id', 'id');
    }
}
