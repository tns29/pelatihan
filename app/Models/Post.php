<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $guarded = ['id'];
    public $timestamps = false;
}
