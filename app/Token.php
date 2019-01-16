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

    public  function liste()
    {
        return auth()->user()->member->company->tokens;
    }

    /**
     * @param Company $company
     * @param int $range
     * @param int $category_id
     * @return Model
     */
    public function onCreate(Company $company, int $range, int $category_id)
    {
        $premium = $company->premium;
        $premium->update(['sold' => $premium->sold - $range]);
        return $company->tokens()->create([
            'range' => $range,
            'token' => md5(sha1(rand())),
            'category_id' => $category_id
        ]);
    }


    public function onDelete()
    {
        $premium = auth()->user()->member->company->premium;

        $premium->update(['sold'  => $premium->sold + $this->range]);

        $this->delete();
    }
}
