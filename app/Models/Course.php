<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'is_premium',
        'tags',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'tags' => 'array',
    ];
}
