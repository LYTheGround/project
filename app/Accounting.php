<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property Company $company
 * @property Purchased $purchaseds
 * @property Sold $solds
 * @property Unload $unloads
 * @property Month $months
 */
class Accounting extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'tva', 'taxes', 'profit', 'taxes_after_unload', 'tva_after_unload', 'company_id'
    ];


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
    public function purchaseds()
    {
        return $this->hasMany(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solds()
    {
        return $this->hasMany(Sold::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function months()
    {
        return $this->hasMany(Month::class);
    }
}
