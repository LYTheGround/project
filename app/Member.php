<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Info $info
 * @property Company $company
 * @property Position $positions
 * @property Premium $premium
 * @property Unload $unloads
 * @property Product $products
 */
class Member extends Model
{
    /**
     * Les attributes assigner en masse
     *
     * @var array
     */
    protected $fillable = ['slug', 'name', 'user_id', 'info_id', 'premium_id', 'company_id'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Chaque membre a un user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info()
    {
        return $this->belongsTo(Info::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function premium()
    {
        return $this->belongsTo(Premium::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unloads()
    {
        return $this->hasMany(Unload::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function identity($user)
    {
        $info = $this->info;
        if ($user->login == $info->emails[0]->email) {
            return 'email';
        }
        if ($user->login == $info->tels[0]->tel) {
            return 'tel';
        }
        return 'name';
    }

    public function buys()
    {
        return DB::table('trade_actions')
            ->where('trade_actions.dv_member_id','=',$this->id)
            ->orWhere('trade_actions.bc_member_id','=',$this->id)
            ->orWhere('trade_actions.done_member_id',$this->id)
            ->orWhere('trade_actions.delivery_member_id',$this->id)
            ->orWhere('trade_actions.store_member_id',$this->id)
            ->orWhere('trade_actions.bl_member_id',$this->id)
            ->orWhere('trade_actions.fc_member_id',$this->id)
            ->join('buys','buys.trade_action_id','trade_actions.id')
            ->select('buys.*', 'trade_actions.tasks')
            ->limit(5)
            ->latest()
            ->get();
    }

    public function sales()
    {
        return DB::table('trade_actions')
            ->where('trade_actions.dv_member_id','=',$this->id)
            ->orWhere('trade_actions.bc_member_id','=',$this->id)
            ->orWhere('trade_actions.done_member_id',$this->id)
            ->orWhere('trade_actions.delivery_member_id',$this->id)
            ->orWhere('trade_actions.store_member_id',$this->id)
            ->orWhere('trade_actions.bl_member_id',$this->id)
            ->orWhere('trade_actions.fc_member_id',$this->id)
            ->join('sales','sales.trade_action_id','trade_actions.id')
            ->select('sales.*', 'trade_actions.tasks')
            ->limit(5)
            ->latest()
            ->get();
    }

    /**
     * @param User $user
     * @param Info $info
     * @param Premium $premium
     * @param int $company_id
     * @param array $data
     */
    public function onCreate(User $user, Info $info, Premium $premium, int $company_id, array $data)
    {
        $user = $user->member()->create([
            'name'  => $data['name'],
            'info_id' => $info->id,
            'premium_id' => $premium->id,
            'company_id' => $company_id
        ]);
        $user->update([
            'slug'  => str_slug($user->name . ' ' . $user->id)
        ]);
    }
}
