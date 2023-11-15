<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
