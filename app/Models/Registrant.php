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

    public function periods() : BelongsTo
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }

    function getWishlist($number) {
        return DB::table('registrants')
                ->select('registrants.*','trainings.title as trainingsTitle',  'trainings.duration', 'trainings.description as description', 'trainings.image as image',
                        'periods.name as gelombang', 'categories.name as category')
                ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                ->leftJoin('periods', 'periods.id', '=', 'registrants.period_id')
                ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                ->where(['participant_number' => $number])->get();
    }

    function getRegistrants($status, $fullname) {
        // die($status);
        if($status == 'Y') {
            $where['registrants.approve'] = "Y";
        } else if($status == 'N') {
            $where['registrants.approve'] = "N";
        } else if($status == 'C') {
            $where['registrants.approve'] = "C";
        } else if($status == 'Z') {
            $where['registrants.approve'] = null;
        } else {
            $where = null;
        }

        if($where == null) {
            return DB::table('registrants')
                    ->select('registrants.*',
                            'participants.fullname as fullname', 'participants.gender as gender', 'participants.email as email',
                            'trainings.title as trainingsTitle', 'trainings.description as description', 'trainings.image as image',
                            'periods.name as gelombang', 'categories.name as category', 'sub_districts.name AS sub_district_name')
                    ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
                    ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                    ->leftJoin('periods', 'periods.id', '=', 'registrants.period_id')
                    ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                    ->leftJoin('sub_districts', 'sub_districts.id', '=', 'participants.sub_district')
                    // ->where($where)
                    ->where('participants.fullname', 'like', '%' . $fullname . '%')
                    ->get();
        } else {
            return DB::table('registrants')
                    ->select('registrants.*',
                            'participants.fullname as fullname', 'participants.gender as gender', 'participants.email as email',
                            'trainings.title as trainingsTitle', 'trainings.description as description', 'trainings.image as image',
                            'periods.name as gelombang', 'categories.name as category', 'sub_districts.name AS sub_district_name')
                    ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
                    ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
                    ->leftJoin('periods', 'periods.id', '=', 'registrants.period_id')
                    ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
                    ->leftJoin('sub_districts', 'sub_districts.id', '=', 'participants.sub_district')
                    ->where($where)
                    ->where('participants.fullname', 'like', '%' . $fullname . '%')
                    ->get();

        }
    }

    function getParticipantPassed($ispassed, $fullname, $training) {
        // Define the base query
        $query = DB::table('registrants')
            ->select(
                'registrants.*',
                'participants.fullname as fullname',
                'participants.gender as gender',
                'participants.email as email',
                'trainings.title as trainingsTitle',
                'trainings.description as description',
                'trainings.image as image',
                'periods.name as gelombang',
                'categories.name as category'
            )
            ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
            ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
            ->leftJoin('periods', 'periods.id', '=', 'registrants.period_id')
            ->leftJoin('categories', 'categories.id', '=', 'trainings.category_id')
            ->where('registrants.approve', '!=', 'N')
            ->where('participants.fullname', 'like', '%' . $fullname . '%')
            ->where('trainings.id', 'like', '%' . $training . '%')
            ->orderBy('date', 'DESC');

        // Determine the condition for `ispassed`
        switch ($ispassed) {
            case 'Y':
            case 'N':
            case 'C':
                $query->where('registrants.passed', $ispassed);
                break;
            case 'X':
                $query->whereNull('registrants.passed');
                break;
            case 'ALL':
                // No additional condition for 'ALL'
                break;
            default:
                return collect(); // Return an empty collection for invalid input
        }

        // Execute and return the query
        return $query->get();
    }

}
