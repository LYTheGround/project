<?php

namespace App;

use App\Notifications\Auth\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package App
 * @property Admin $admin
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * Cette Table consiste uniquement a se connecter.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at'    => 'datetime:d-m-Y',
        'updated_at'    => 'datetime:d-m-Y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buys()
    {
        return $this->hasMany(Buy::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @param array $data
     * @return User
     */
    public function onCreate(array $data)
    {
        return $this->create([
            "login"     => $data['name'],
            "email"     => $data['email'],
            "password"  => bcrypt($data['password']),
        ]);
    }

    public function onCreateUser($data,Info $info,Premium $premium,Member $member)
    {
        $face = null;

        if(!is_null($data['face'])) $face = $data['face']->store('users');

        $user = $this->onCreate($data);

        $info = $info->onCreate($face, $data);

        $info->emails()->create(['email' => $data['email'], 'default' => 1]);

        $info->tels()->create(['tel' => $data['phone'], 'default' => 1]);

        $token = Token::where('token', $data['token'])->first();

        $premium = $premium->onCreate($token);

        $member->onCreate($user, $info, $premium, $token->company_id, $data);

        return $user;
    }

}
