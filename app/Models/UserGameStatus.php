<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGameStatus extends Model
{
    use HasUuids;
    protected $keyType = "string";
    public $incrementing = false;

    public $fillable = [
        'status',
        'user_id',
        'game_id'
    ];

    /**
     * @return HasMany<User,UserGameStatus>
     */
    public function user_ids(): HasMany {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /**
     * @return HasMany<Game,UserGameStatus>
     */
    public function game_ids(): HasMany {
        return $this->hasMany(Game::class, 'id', 'game_id');
    }
}
