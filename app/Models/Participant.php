<?php

namespace App\Models;

use App\Models\Grade;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $primaryKey = 'number';
    public $timestamps = false;

    protected $fillable = [
        'number',
        'fullname',
        'username',
        'gender',
        'no_telp', 
        'place_of_birth',
        'date_of_birth',
        'address',
        'grade',
        'is_active',
        'email',
        'password',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade', 'id');
    }
}
