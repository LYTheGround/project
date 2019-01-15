<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchased extends Model
{
    protected $fillable = ['slug', 'qt', 'store_qt', 'offer_qt', 'product_id','month_id', 'accounting_id', 'buy_order_id'];

    public function buy_order()
    {
        return $this->belongsTo(Buy_order::class,'buy_order_id');
    }

    public function sale_bcs()
    {
        return $this->hasMany(Sale_bc::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function accounting()
    {
        return $this->belongsTo(Accounting::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productAmount()
    {
        return $this->hasOne(Amount_product::class);
    }
}
