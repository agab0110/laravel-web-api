<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

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

    public function project(): BelongsTo {      // utilizzando la naming convention non c'è bisogno del nome della colonna
        return $this->belongsTo(Project::class);
    }

    protected static function booted(): void {      // metodo globale per far si che si vedano solo le tasks dell'utente loggato
        static::addGlobalScope('creator', function (Builder $builder) {
            $builder->where('creator_id', Auth::id());      // non so perché da errore ma funziona
        });
    }
}
