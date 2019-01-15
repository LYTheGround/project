<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Info_box
 * @package App
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property City $city
 * @property Email $emails
 * @property Tel $tels
 * @property Provider $provider
 * @property Client $client
 */
class Info_box extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['brand', 'name', 'slug', 'licence', 'ice', 'turnover', 'taxes', 'fax', 'speaker', 'address', 'build', 'floor', 'apt_nbr', 'zip', 'city_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tels()
    {
        return $this->hasMany(Tel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
