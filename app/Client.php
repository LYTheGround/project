<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Company $company
 * @property Info_box $info_box
 * @property Sale_dv $dvs
 * @property User $user
 */
class Client extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'description', 'company_id', 'user_id', 'info_box_id'];

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
    public function info_box()
    {
        return $this->belongsTo(Info_box::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dvs()
    {
        return $this->hasMany(Sale_dv::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('min_prince', 'updated_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
