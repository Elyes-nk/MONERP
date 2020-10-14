<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 //utilise les modeles suivant
use \App\Product;
use \App\Taxe;
use \App\Warehouse;
use \App\CategoryProduct;
use \App\ProductUnity;
use \App\Company;
use App\ReplishippementRule;


class productsController extends Controller
{
    public function __construct()
    {
        $this->middleware('superuser');
        $this->middleware('auth');
        $this->middleware('sequences');
        $this->middleware('products');
    }
    public function index()
    {
        $products = Product::All();
        //$products = products::where('notes',$request->query('notes','pas null'))->get();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product=Product::find($id);
        if(! $product)
        {
            return redirect()->route('products.index');
        }
        $Taxes = Taxe::All();
        $Warehouses = Warehouse::All();
        $Category_products = CategoryProduct::All();
        $Product_unities = ProductUnity::All();
        $id_next=Product::where('id','<',$id)->orderBy('id','desc')->first();
        if(!$id_next){
            $id_next = Product::first();
        }
        $id_previous=Product::where('id','>',$id)->first();
        if(!$id_previous){
            $id_previous = Product::first();
        }
        return view('products.show', compact('product','Taxes', 'Warehouses', 'Category_products', 'Product_unities','id_next','id_previous'));

    }

    public function create()
    {
        $products = new Product();
        $Taxes = Taxe::All();
        $Warehouses = Warehouse::All();
        $Category_products = CategoryProduct::All();
        $Product_unities = ProductUnity::All();
        return view('products.create', compact('products', 'Taxes', 'Warehouses', 'Category_products', 'Product_unities'));
    }

    public function store(Request $request)
    {

        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputRef'=>'required',
            'inputSale_price'=>'required|numeric|Min:0',
            'inputStandard_price'=>'required|numeric|Min:0',
            'inputStock_alerte'=>'required|numeric|Min:0',
            'inputOptimal_stock'=>'required|numeric|Min:0',
            'inputProcurement'=>'required',
            'inputType'=>'required',
            'inputTaxe'=>'required',
            'inputWarehouse'=>'required',
            'inputCategory_product'=>'required',
            'inputProduct_unities'=>'required',
    ]);
        $product = $company->products()->create([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'ref'=>$request->inputRef,
            'sale_price'=>$request->inputSale_price,
            'standard_price'=>$request->inputStandard_price,
            'alerte_stock'=>$request->inputStock_alerte,
            'optimal_stock'=>$request->inputOptimal_stock,
            'physical_stock'=>'0',
            'virtual_stock'=>'0',
            'procurement_method'=>$request->inputProcurement,
            'type'=>$request->inputType,
            'taxe_id'=>$request->inputTaxe,
            'warehouse_id'=>$request->inputWarehouse,
            'category_product_id'=>$request->inputCategory_product,
            'unity_id'=>$request->inputProduct_unities,
        ]);
        session()->flash('message','Article ajouté avec succès !');

        for($i=0;$i<$request->cmpt;$i++){

            $r=$request->all();
            $product->suppliers()->create([
                "tier_id"=>$r["id_tier_".$i],
                "delai"=>$r["delai_".$i],
                "price"=>$r["price_".$i],
                "qtt_min"=>$r["qttmin_".$i],
                "user_id"=>Auth::user()->id,
                "company_id"=>$product->company_id,
            ]);
        }
        if($product->procurement_method=="Planifié"){
            $rule=ReplishippementRule::create([
                "name"=>$product->name,
                "product_id"=>$product->id,
                "warehouse_id"=>$product->warehouse_id,
                "user_id"=>Auth::user()->id,
                "company_id"=>$company->id,
            ]);
        }
        return redirect()->route('products.show',["product"=>$product->id]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        if(! $product)
        {
            return redirect()->route('products.index');
        }
        $Taxes = Taxe::All();
        $Warehouses = Warehouse::All();
        $Category_products = CategoryProduct::All();
        $Product_unities = ProductUnity::All();
        return view('products.edit', compact('product', 'Taxes', 'Warehouses', 'Category_products', 'Product_unities'));
    }

    public function update(Request $request,$id)
    {
        /*$product->update($this->ValidateData()); */
        $company=Company::first();
        $this->validate($request,[
            'inputName'=>'required',
            'inputRef'=>'required',
            'inputSale_price'=>'required|numeric|Min:0',
            'inputStandard_price'=>'required|numeric|Min:0',
            'inputStock_alerte'=>'required|numeric|Min:0',
            'inputOptimal_stock'=>'required|numeric|Min:0',
            'inputProcurement'=>'required',
            'inputType'=>'required',
            'inputTaxe'=>'required',
            'inputWarehouse'=>'required',
            'inputCategory_product'=>'required',
            'inputProduct_unities'=>'required',
    ]);
        $product=Product::findOrFail($id);
        $product->update([
            'user_id'=>Auth::user()->id,
            'name'=>$request->inputName,
            'ref'=>$request->inputRef,
            'sale_price'=>$request->inputSale_price,
            'standard_price'=>$request->inputStandard_price,
            'alerte_stock'=>$request->inputStock_alerte,
            'optimal_stock'=>$request->inputOptimal_stock,
            'physical_stock'=>$request->inputPhysical_stock,
            'virtual_stock'=>$request->inputVirtual_stock,
            'procurement_method'=>$request->inputProcurement,
            'type'=>$request->inputType,
            'taxe_id'=>$request->inputTaxe,
            'warehouse_id'=>$request->inputWarehouse,
            'category_product_id'=>$request->inputCategory_product,
            'unity_id'=>$request->inputProduct_unities,
        ]);
        session()->flash('message','L\'article a était mis à jour avec succès !');

        if($request->inputProcurement=="Planifié"){
            $prr_id=ReplishippementRule::where('product_id',$product->id)->get();
            if(count($prr_id)==0){
            $rule=ReplishippementRule::create([
                "name"=>$product->name,
                "product_id"=>$product->id,
                "warehouse_id"=>$product->warehouse_id,
                "user_id"=>Auth::user()->id,
                "company_id"=>$company->id,
            ]);
            }
        }
        else{
            $prr_ids=ReplishippementRule::where('product_id',$product->id)->get();
            foreach($prr_ids as $prr_id){
                $prr_id->delete();
            }
        }
        return redirect()->route('products.show',["product"=>$product->id]);
    }

    public function destroy($id)
    {
        $product=Product::find($id);

        $product->delete();
        return redirect()->route('products.index');
    }
}
