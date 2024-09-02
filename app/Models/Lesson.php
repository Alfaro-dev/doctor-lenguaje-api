<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_id', 
        'title', 
        'description', 
        'grammar_topic', 
        'objective', 
        'vocabulary', 
        'verbs', 
        'native_expression', 
        'content'
    ];

    protected $casts = [
        'vocabulary' => 'array',
        'verbs' => 'array',
        'native_expression' => 'array',
        'content' => 'array',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class)->withTrashed();
    }
}
