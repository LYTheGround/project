<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * @package App
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Info $info
 * @property Info_box $info_boxes
 */
class Email extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'default', 'info_id', 'info_box_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info()
    {
        return $this->belongsTo(Info::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function info_boxes()
    {
        return $this->hasMany(Info::class);
    }
}
