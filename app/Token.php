<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['range', 'token', 'category_id', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param Premium $premium
     * @param int $range
     * @param int $category_id
     * @return Model
     */
    public function onCreate(Premium $premium, int $range, int $category_id)
    {
        $premium->update(['sold' => $premium->sold - $range]);
        return $premium->tokens()->create([
            'range' => $range,
            'token' => md5(sha1(rand())),
            'category_id' => $category_id
        ]);
    }
}
