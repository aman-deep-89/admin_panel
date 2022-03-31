<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::all();
        return view('product/index',['product'=>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([  
            'product_name'=>'required',
            'sku'=>'required',
            'price'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $product = new product();
		$product->name = $request->get('product_name');
		$product->description = $request->get('product_description');
		$product->sku = $request->get('sku');
		$product->price = $request->get('price');
		$product->p_enable = $request->get('p_enable')== null ? 1 :  $request->get('p_enable');
		$product->out_of_stock = $request->get('out_of_stock')== null ? 1 :  $request->get('out_of_stock');
		$product->opening_stock = User::count();
		$product->closing_stock = User::count();
		$product->photos = $request->get('filenames');
        $product->save();
        if($product->id) {
            return redirect()->route('product.index') ->with('success', 'Product created successfully.');
        } else {
            return redirect()->route('product.index') ->with('error', 'There is an error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('product/edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([  
            'product_name'=>'required',
            'sku'=>'required',
            'price'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $product = Product::find($id);
		$product->name = $request->post('product_name');
		$product->description = $request->post('product_description');
		$product->sku = $request->post('sku');
		$product->price = $request->post('price');
        $product->out_of_stock = $request->post('out_of_stock')== null ? 1 :  $request->post('out_of_stock');
		$product->p_enable = $request->post('p_enable')== null ? 1 :  $request->post('p_enable');
		$product->photos = $request->post('filenames');
        $product->save();
        if($product->id) {
            return redirect()->route('product.index') ->with('success', 'Product updated successfully.');
        } else {
            return redirect()->route('product.index') ->with('error', 'There is an error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        //dd(DB::getQueryLog());  exit;
        return redirect()->route('product.index') ->with('success', 'Product deleted successfully.');
    }
    public function view_accounts($pd_id) {
        $products=Product::find($pd_id);
        return view('product/view_accounts',['product'=>$products]);
    }
}