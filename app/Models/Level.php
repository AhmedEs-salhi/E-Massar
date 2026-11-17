<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    protected $fillable = ['title'];

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class, 'level_id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'level_id');
    }
}
