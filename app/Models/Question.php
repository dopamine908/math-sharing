<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property int $users_id
 * @property int $likes
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
}
