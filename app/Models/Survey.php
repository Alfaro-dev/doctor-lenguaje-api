<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'reason',
        'time_commitment',
        'current_level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
