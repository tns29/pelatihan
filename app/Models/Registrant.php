<?php

namespace App\Models;

use App\Models\Training;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registrant extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $primary = 'id';
    public $timestamps = false;

    /**
    * Get the user that owns the Registrant
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function participants(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant_number', 'number');
    }
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }

    function getWishlist($number) {
        return DB::table('registrants')
                ->select('registrants.*','trainings.title as trainingsTitle',  'trainings.duration', 'trainings.description as description', 'trainings.image as image',
                        'periods.name as gelombang', 'categories.name as category')
                ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                ->leftJoin('periods', 'periods.id', '=', 'trainings.period_id') 
                ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                ->where(['participant_number' => $number])->get();
    }

    function getRegistrants($status, $fullname) {
        return DB::table('registrants')
                ->select('registrants.*',
                        'participants.fullname as fullname', 'participants.gender as gender', 'participants.email as email',
                        'trainings.title as trainingsTitle', 'trainings.description as description', 'trainings.image as image',
                        'periods.name as gelombang', 'categories.name as category', 'sub_districts.name AS sub_district_name')
                ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
                ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                ->leftJoin('periods', 'periods.id', '=', 'trainings.period_id') 
                ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                ->leftJoin('sub_districts', 'sub_districts.id', '=', 'participants.sub_district')
                // ->where(['registrants.approve' => $status])
                ->where('participants.fullname', 'like', '%' . $fullname . '%')
                ->get();
    }
    
    function getParticipantPassed($ispassed, $fullname) {
        $where = ['registrants.approve' => 'Y'];
        if($ispassed == 'Y') {
            $where['registrants.Passed'] = "Y";
        } else if($ispassed == 'N') {
            $where['registrants.Passed'] = "N";
        } else if($ispassed == 'C') {
            $where['registrants.Passed'] = "C";
        } else {
            // $where['registrants.Passed'] = null;
        }
        // dd($ispassed);
        return DB::table('registrants')
                ->select('registrants.*',
                        'participants.fullname as fullname', 'participants.gender as gender', 'participants.email as email',
                        'trainings.title as trainingsTitle', 'trainings.description as description', 'trainings.image as image',
                        'periods.name as gelombang', 'categories.name as category')
                ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
                ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                ->leftJoin('periods', 'periods.id', '=', 'trainings.period_id') 
                ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                // ->where('registrants.Passed', '!=', NULL)
                ->where($where)
                ->where('participants.fullname', 'like', '%' . $fullname . '%')
                ->get();
    }
}
