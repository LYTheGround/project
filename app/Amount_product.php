<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Product $product
 * @property Purchased $purchased
 * @property Company $company
 */
class Amount_product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['qt', 'ttcu', 'total', 'history', 'product_id', 'purchased_id', 'company_id'];

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
    public function purchased()
    {
        return $this->belongsTo(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
