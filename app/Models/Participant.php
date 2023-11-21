<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\SubDistrict;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Participant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'grade_id',
        'is_active',
        'sub_district',
        'village',
        'email',
        'password',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    
    public function sub_districts(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district', 'id');
    }

    public function getUserProfile() {
        $number = auth('participant')->user()->number;
        $data = DB::table('participants')
            ->select('participants.*','sub_districts.name as sub_district_name', 'villages.name as village_name')
            ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
            ->leftJoin('villages', 'participants.village', '=', 'villages.id')
            ->where(['number' => $number])
            ->first();
        return $data;
    }
}
