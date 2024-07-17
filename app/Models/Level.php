<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'lenguaje_id'
    ];

    public function lenguaje()
    {
        return $this->belongsTo(Lenguaje::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
