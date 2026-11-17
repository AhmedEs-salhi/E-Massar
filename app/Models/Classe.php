<?php

namespace App\Models;

use App\Enum\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    protected $table = 'classes';
    protected $fillable = ['title', 'level_id'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'class_id')->where('role', UserRole::Student);
    }
}
