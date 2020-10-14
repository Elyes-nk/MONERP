<?php

namespace App\Http\Middleware;

use Closure;
use App\Currency;
use App\Sequence;

class DefaultData
{
    public function handle($request, Closure $next)
    {
        $Currencies=Currency::first();
        if(! $Currencies){
            $request->session()->flash('no_Currency', 'Attention !! Les devises ne sont pas encore définies');
        }
        $sequences=Sequence::first();
        if(! $sequences){
            $request->session()->flash('no_sequence', 'Attention !! Les séquences ne sont pas encore définies');
        }
        if(! $sequences || ! $Currencies )
        {
            return redirect('home');
        }
        return $next($request);
    }
}
