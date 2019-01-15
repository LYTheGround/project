<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Buy_order
 * @package App
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Buy_dv $dv
 * @property Purchased $purchased
 * @property Buy_bc $bc
 */
class Buy_order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['pu', 'ht', 'tva', 'ttc', 'buy_dv_id', 'buy_bc_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dv()
    {
        return $this->belongsTo(Buy_dv::class, 'buy_dv_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchased()
    {
        return $this->hasOne(Purchased::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bc()
    {
        return $this->belongsTo(Buy_bc::class, 'buy_bc_id');
    }
}
