<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Buy $buy
 * @property Sale $sale
 * @property Company $company
 */
class Echeance extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prince','date','payed', 'buy_id','sale_id','company_id'];

    public function buy()
    {
        return $this->belongsTo(Buy::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
