<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $description
 * @property int $users_id
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 */
class Question extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
