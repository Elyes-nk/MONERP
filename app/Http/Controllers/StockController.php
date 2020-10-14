<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class StockController extends Controller
{
   
    public function index()
    {
        $products = Product::All();
        return view('stock.index', compact('products'));
    }

}
