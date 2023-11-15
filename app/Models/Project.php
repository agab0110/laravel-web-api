<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

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

    protected static function booted(): void {      // metodo globale per far si che si possano vedere le informazione dei project creati dell'utente loggato
        static::addGlobalScope('creator', function (Builder $builder) {
            $builder->where('creator_id', Auth::id());      // non so perché da errore ma funziona
        });
    }
}
