<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Member $member
 * @property City $city
 * @property Email $emails
 * @property Tel $tels
 * @property Position $position
 */
class Info extends Model
{
    /**
     * All attributes was assigned in mass
     *
     * @var array
     */
    protected $fillable = ['face', 'last_name', 'first_name', 'sex', 'birth', 'address', 'address', 'cin', 'city_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class);
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
    public function position()
    {
        return $this->hasOne(Position::class);
    }
}
