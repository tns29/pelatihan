<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminLevel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    /**
     * Get all of the admins for the AdminLevel
     *
     * @return HasMany
     */
    // public function admins(): HasMany
    // {
    //     return $this->hasMany(Admin::class, 'level_id', 'id');
    // }
}
