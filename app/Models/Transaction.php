<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $order_id
 *
 * @property-read Order $order
 *
 * @mixin Builder
 */
final class Transaction extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @var array
     */
    protected $fillable = [
        'order_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'order_id' => 'int',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id', 'order');
    }
}
