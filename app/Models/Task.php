<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [     // campi che possono essere inseriti da un form
        'title',
        'completed'
    ];

    protected $hidden = [       // campi che verranno protetti dall'output
        'updated_at',
        'created_at'
    ];

    protected $casts = [        // campi a cui vengono fatti dei cast per l'output
        'completed' => 'boolean'
    ];
}
