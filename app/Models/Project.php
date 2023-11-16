<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tasks(): HasMany {      // grazie alla naming convention possiamo omettere la colonna a cui si riferisce
        return $this->hasMany(Task::class);
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function members(): BelongsToMany {      // funzione per la chiave esterna della relazione many-to-many tra user e project
        return $this->belongsToMany(User::class, Member::class);
    }

    protected static function booted(): void {      // metodo globale per controllare che l'id dell'utente loggato faccia parte dei members di un progetto
        static::addGlobalScope('member', function (Builder $builder) {
            $builder->whereRelation('members', 'user_id', Auth::id());      // non so perché da errore ma funziona
        });
    }
}
