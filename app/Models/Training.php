<?php

namespace App\Models;

use App\Models\Category;
use App\Models\TrainingDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    public $guarded = ['id'];
    public $timestamps = false;

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function service_detail() : BelongsTo
    {
        return $this->belongsTo(TrainingDetail::class, 'training_id', 'id');
    }
    public function periods() : BelongsTo
    {
        return $this->belongsTo(Period::class, 'period_id', 'id');
    }
}
