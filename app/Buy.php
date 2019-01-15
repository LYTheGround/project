<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * @property array $fillable
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property Trade_action $trade_action
 * @property Buy_bc $bcs
 * @property Buy_dv $dvs
 * @property User $user
 * @property Echeance $echeance
 * @property Month $month
 */
class Buy extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'ht', 'tva', 'ttc', 'user_id', 'company_id', 'trade_action_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trade_action()
    {
        return $this->belongsTo(Trade_action::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bcs()
    {
        return $this->hasMany(Buy_bc::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dvs()
    {
        return $this->hasMany(Buy_dv::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function finish()
    {
        return $this->belongsTo(Trade_action::class)->where('status', '=', 'finish');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function echeance()
    {
        return $this->hasOne(Echeance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
