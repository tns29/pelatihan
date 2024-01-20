<?php

namespace App\Models;

use App\Models\AdminLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    
    public $primaryKey = 'number';
    public $keyType = 'string';
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
        'level_id',
        'is_active',
        'email',
        'password',
        'images',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    protected $hidden = [ 
        'password',
        'remember_token',
    ];

    public function admin_level(): BelongsTo
    {
        return $this->belongsTo(AdminLevel::class, 'level_id', 'id');
    }
}
