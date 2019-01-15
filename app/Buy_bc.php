<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Product $product
 * @property Buy $buy
 * @property Buy_order $order
 */
class Buy_bc extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['qt', 'buy_id', 'product_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buy()
    {
        return $this->belongsTo(Buy::class);
    }

    public function order()
    {
        return $this->hasOne(Buy_order::class);
    }
}
