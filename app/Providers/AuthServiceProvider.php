<?php

namespace App\Providers;

use App\Admin;
use App\Member;
use App\Policies\AdminPolicy;
use App\Policies\MemberPolicy;
use App\Policies\PositionPolicy;
use App\Policies\TokenPolicy;
use App\Position;
use App\Token;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Token::class => TokenPolicy::class,
        Member::class => MemberPolicy::class,
        Position::class => PositionPolicy::class,
        Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
