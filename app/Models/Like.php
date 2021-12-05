<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $users_id
 * @property string $resource
 * @property int $resource_id
 * @property CarbonImmutable $created_at
 */
class Like extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'immutable_datetime',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
