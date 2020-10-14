<?php

namespace App\Http\Middleware;

use Closure;
use \App\ListPrice;

class DefaultDataTier
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
        $ListPrices=ListPrice::first();
        if(! $ListPrices){
            $request->session()->flash('no_ListPrice', 'Attention !! Les listes de prix ne sont pas encore définies');
            return redirect('home');
        }
        return $next($request);
    }
}
