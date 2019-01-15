<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 * @property int $id
 * @property Premium $premiums
 * @property Token $tokens
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['category'];


    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function premiums()
    {
        return $this->hasMany(Premium::class);
    }

    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}
