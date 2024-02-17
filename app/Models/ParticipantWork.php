<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipantWork extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $timestamps = false;

    public function participants(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'participant_number', 'number');
    }

    function dataPartisipantWork($filter, $fullname) {
        if($filter) {
            $where['p.sub_district'] = $filter;
            $data = DB::table('participant_works as pw')
                        ->select('pw.*', 'sd.name as sub_districts_name', 'p.nik', 'p.fullname', 'p.number as participant_number', 'p.no_wa',
                        DB::raw('(SELECT t.title FROM registrants as r left join trainings as t on t.id = r.training_id left join participants p1 on p1.number = r. participant_number order by r.id desc limit 1) as training_name'))
                        ->leftJoin('participants as p', 'p.number', '=', 'pw.participant_number')
                        ->leftJoin('sub_districts as sd', 'sd.id', '=', 'p.sub_district')
                        ->where($where)
                        ->where('p.fullname', 'like', '%' . $fullname . '%')
                        ->get();
        } else {
            $data = DB::table('participant_works as pw')
                        ->select('pw.*', 'sd.name as sub_districts_name', 'p.nik', 'p.fullname', 'p.number as participant_number', 'p.no_wa',
                        DB::raw('(SELECT t.title FROM registrants as r left join trainings as t on t.id = r.training_id left join participants p1 on p1.number = r. participant_number order by r.id desc limit 1) as training_name'))
                        ->leftJoin('participants as p', 'p.number', '=', 'pw.participant_number')
                        ->leftJoin('sub_districts as sd', 'sd.id', '=', 'p.sub_district')
                        ->where('p.fullname', 'like', '%' . $fullname . '%')
                        ->get();
        }
        // die($data);
        return $data;
    }
    
}
