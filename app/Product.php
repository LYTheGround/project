<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'name', 'ref', 'tva', 'size', 'description', 'qt', 'qt_min', 'amount', 'min_prince', 'company_id'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imgs()
    {
        return $this->hasMany(Product_img::class);
    }

    public function buy_bcs()
    {
        return $this->hasMany(Buy_bc::class);
    }

    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class)->withPivot('min_prince', 'updated_at','created_at');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class)->withPivot('min_prince', 'updated_at', 'created_at');
    }

    public function productAmounts()
    {
        return $this->hasMany(Amount_product::class);
    }
}
