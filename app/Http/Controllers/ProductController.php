<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $userRole=Auth::user()->role;
        $product = Product::all();
        return view('product.index', ['products' => $product, 'role' => $userRole]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(){
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){

        $request->validate([
            'product_name' => 'required',
            'desc' => 'required',
            'price' => 'required'
        ]);
 
        $newProduct = Product::create($request->all());

        return redirect(route('product.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        return view('product.edit', ['product' => $product]);
    }

    
    public function getProductByTransaction(Transaction $transaction){
    
        $userRole=Auth::user()->role;
        $transaction->load('transactionProducts.product');
        
        foreach ($transaction->transactionProducts as $item) {
            $item->total_price = $item->qty * $item->product->price;
        }
        
        error_log($transaction);
        return view('product.get-product', ['transaction' => $transaction, 'role' => $userRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Product $product, Request $request){
        $data = $request->validate([
            'product_name' => 'required',
            'desc' => 'required',
            'price' => 'required'
        ]);
 
        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product Updated Succesffully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Product $product){
        $product->delete();
        error_log("masuk ding");
        return redirect(route('product.index'))->with('success', 'Product deleted Succesffully');
    }
}
