<?php

namespace App\Models;

use App\Enums\ProgressStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
        'score',
        'responses',
        'experience_gained'
    ];

    protected $casts = [
        'status' => ProgressStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
