<?php

namespace App\Http\Middleware;

use Closure;
use \App\ListPrice;
use \App\CategoryProduct;
use \App\ProductUnity;
use \App\Warehouse;
use \App\Taxe;


class DefaultDataProduct
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
        $Taxes=Taxe::first();
        if(! $Taxes){
            $request->session()->flash('no_Taxe', 'Attention !! Les taxes ne sont pas encore définies');
        }
        $CategoryProducts=CategoryProduct::first();
        if(! $CategoryProducts){
            $request->session()->flash('no_CategoryProduct', 'Attention !! Les catégories de produit ne sont pas encore définies');
        }
        $ProductUnitys=ProductUnity::first();
        if(! $ProductUnitys){
            $request->session()->flash('no_ProductUnity', 'Attention !! Les unités de produit ne sont pas encore définies');
        }
        $Warehouses=Warehouse::first();
        if(! $Warehouses){
            $request->session()->flash('no_Warehouse', 'Attention !! Les entrepôts ne sont pas encore définies');
        }
        if(! $Taxes || ! $CategoryProducts  || ! $ProductUnitys || ! $Warehouses )
        {
            return redirect('home');
        }
        return $next($request);
    }
}
