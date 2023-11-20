<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDetail extends Model
{
    use HasFactory;
    public $table = 'training_details';
    public $guarded = ['id'];
    public $timestamps = false;
}
