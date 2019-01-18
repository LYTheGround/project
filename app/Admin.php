<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Cette table consiste a indiquez les administrateurs.
 *
 * Class Admin
 * @package App
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 * @property string $type
 * @property User $user
 * @property City $city
 * @property Company $companies
 */
class Admin extends Model
{

    /**
     *
     * @var array
     */
    protected $fillable = ['type', 'tel', 'user_id','city_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    /**
     * liste de tous les administrateurs.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function liste()
    {
        return self::with(['user','city'])->get();
    }

    /**
     * Crée un nouveau administrateur
     * @param $request
     * @return mixed
     */
    public static function onCreate($request)
    {
        return User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->admin()->create([
            'type' => 'B',
            'tel' => $request->tel,
            'city_id' => $request->city
        ]);
    }

    public  function onShow()
    {
        return $this->user->companies()->with(['info_box.tels', 'info_box.emails', 'premium.status'])->get();
    }

    public function onUpdate($request)
    {
        auth()->user()->email = $request->email;
        auth()->user()->login = $request->login;
        if($request->password){
            auth()->user()->password = Hash::make($request->password);
        }
        auth()->user()->save();
        auth()->user()->admin->update(['city_id' => $request->city, 'tel' => $request->tel]);
        return auth()->user()->admin;
    }

    public function ownerSwitch(int $owner_id)
    {
        foreach ($this->companies as $company) {
            $company->update(['admin_id' => $owner_id]);
        }
    }

}
