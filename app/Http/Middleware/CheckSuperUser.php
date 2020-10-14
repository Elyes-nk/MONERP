<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class CheckSuperUser
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
        $user=User::first();
        if(!$user){
            return redirect('register');
        }
        return $next($request);
    }
}
