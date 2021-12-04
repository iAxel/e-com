<?php

namespace App\Models;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Token
 *
 * @property int $id
 *
 * @property string $value
 *
 * @property int $user_id
 * @property string $user_ip
 * @property string $user_agent
 *
 * @property Carbon|null $used_at
 * @property Carbon|null $expired_at
 *
 * @property-read User $user
 *
 * @method static Builder findByValue(string $value)
 *
 * @mixin Builder
 */
final class Token extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'tokens';

    /**
     * @var array
     */
    protected $fillable = [
        'value',
        'user_id',
        'user_ip',
        'user_agent',
        'used_at',
        'expired_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'value' => 'string',
        'user_id' => 'int',
        'user_ip' => 'string',
        'user_agent' => 'string',
        'used_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    /**
     * @param Builder $query
     * @param string $value
     *
     * @return Builder
     */
    public function scopeFindByValue(Builder $query, string $value): Builder
    {
        return $query->where('value', '=', $value);
    }
}
