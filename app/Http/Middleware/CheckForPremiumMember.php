<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LimitController;
use Closure;

class CheckForPremiumMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $plan = new LimitController();

        if(!$plan->UserPlan(auth()->user())){
            auth()->logout();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
