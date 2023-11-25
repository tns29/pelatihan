<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public $primary = 'id';
    public $guarded = ['id'];
    public $timestamps = false;
}
