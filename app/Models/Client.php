<?php

namespace App\Models;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Client
 *
 * @property int $id
 *
 * @property string $ft_name
 * @property string $lt_name
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection $orders
 * @property-read Collection $transactions
 *
 * @method static Builder filter(array $attributes)
 *
 * @mixin Builder
 */
final class Client extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'clients';

    /**
     * @var array
     */
    protected $fillable = [
        'ft_name',
        'lt_name',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'ft_name' => 'string',
        'lt_name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'client_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Order::class, 'client_id', 'order_id', 'id', 'id');
    }

    /**
     * @param Builder $query
     * @param array $attributes
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $attributes): Builder
    {
        return $query
            ->when($attributes['id'] ?? null, fn ($query, $id) => $query->where('id', '=', $id))
            ->when($attributes['ft_name'] ?? null, fn ($query, $ftName) => $query->where('ft_name', 'like', "%$ftName%"))
            ->when($attributes['lt_name'] ?? null, fn ($query, $ltName) => $query->where('lt_name', 'like', "%$ltName%"))
            ->when($attributes['created_at'] ?? null, fn ($query, $createdAt) => $query->whereBetween('created_at', [$createdAt['from'], $createdAt['to']]))
            ->when($attributes['updated_at'] ?? null, fn ($query, $updatedAt) => $query->whereBetween('updated_at', [$updatedAt['from'], $updatedAt['to']]))
            ->when($attributes['sort'] ?? null, fn ($query, $sort) => $query->orderBy($sort['by'], $sort['type']));
    }
}
