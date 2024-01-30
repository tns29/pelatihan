<?php

namespace App\Models;

use App\Models\Participant;
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
    
}
