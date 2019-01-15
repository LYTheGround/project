<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Admin $admins
 * @property Info $infos
 * @property Info_box $info_boxes
 */
class City extends Model
{
    /**
     * All attributes was assigned in mass
     *
     * @var array
     */
    protected $guarded = ['city'];

    /**
     * @var array
     */
    protected $casts = [
        'created_at'    => 'datetime:d-m-Y',
        'updated_at'    => 'datetime:d-m-Y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function infos()
    {
        return $this->hasMany(Info::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function info_boxes()
    {
        return $this->hasMany(Info_box::class);
    }
}
