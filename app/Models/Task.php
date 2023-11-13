<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function creator(): BelongsTo {      // questa funzione sta ad indicare una relazione many-to-one con la tabella utenti
        return $this->belongsTo(User::class, 'creator_id');
    }
}
