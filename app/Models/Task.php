<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];
}
