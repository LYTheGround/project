<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Accounting $accounting
 * @property Member $members
 * @property Premium $premium
 * @property Info_box $info_box
 * @property Token $tokens
 * @property Position $positions
 * @property Provider $providers
 * @property Client $clients
 * @property Product $products
 * @property Buy $buys
 * @property Sale $sales
 * @property Echeance $echeances
 * @property Amount_product $amount_products
 * @property User $user
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'info_box_id', 'premium_id', 'user_id'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function accounting()
    {
        return $this->hasOne(Accounting::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info_box()
    {
        return $this->belongsTo(Info_box::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    /**
     * @return HasMany
     */
    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    /**
     * @return HasMany
     */
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    /**
     * @return HasMany
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany
     */
    public function buys()
    {
        return $this->hasMany(Buy::class);
    }

    /**
     * @return HasMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * @return HasMany
     */
    public function echeances()
    {
        return $this->hasMany(Echeance::class);
    }

    /**
     * @return HasMany
     */
    public function amountProducts()
    {
        return $this->hasMany(Amount_product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * activate Company where pdg register
     */
    public function activate()
    {
        $premium = $this->premium;
        $date = (int)$premium->range;
        $premium->update(['range' => 0, 'limit' => gmdate("Y-m-d", strtotime("+$date days")), 'status_id' => Status::where('status', 'active')->first()->id]);
    }


}
