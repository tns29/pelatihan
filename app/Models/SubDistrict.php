<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    use HasFactory;

    public $table = 'sub_districts';
    public $keyType = 'int';
    public $guarded = ['id'];
    public $timestamps = false;
}
