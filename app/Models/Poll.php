<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasUuids;
    protected $fillable = [
        'title',
        'time_limit',
        'user_id'
    ];

    public function alternatives(): HasMany{
        return $this->hasMany(Alternative::class);
    }

    public function votes(): HasMany{
        return $this->hasMany(Vote::class);
    }
}
