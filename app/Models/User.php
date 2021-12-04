<?php

namespace App\Models;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * App\Models\User
 *
 * @property int $id
 *
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection $tokens
 *
 * @method static Builder filter(array $attributes)
 *
 * @mixin Builder
 */
final class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use HasFactory;

    use Auth\Authenticatable;
    use Auth\Access\Authorizable;

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class, 'user_id', 'id');
    }

    /**
     * @param array $userData
     *
     * @return Token
     */
    public function createToken(array $userData): Token
    {
        return $this->tokens()->create($userData);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function deleteToken(string $value): void
    {
        $this->tokens()->where('value', '=', $value)->delete();
    }

    /**
     * @param string $value
     *
     * @return void
     */
    public function deleteTokens(string $value): void
    {
        $this->tokens()->where('value', '!=', $value)->delete();
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
            ->when($attributes['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', "%$name%"))
            ->when($attributes['email'] ?? null, fn ($query, $email) => $query->where('email', 'like', "%$email%"))
            ->when($attributes['created_at'] ?? null, fn ($query, $createdAt) => $query->whereBetween('created_at', [$createdAt['from'], $createdAt['to']]))
            ->when($attributes['updated_at'] ?? null, fn ($query, $updatedAt) => $query->whereBetween('updated_at', [$updatedAt['from'], $updatedAt['to']]))
            ->when($attributes['sort'] ?? null, fn ($query, $sort) => $query->orderBy($sort['by'], $sort['type']));
    }
}
