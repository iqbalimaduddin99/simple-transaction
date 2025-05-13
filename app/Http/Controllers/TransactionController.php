<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Transaction_Product;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    { 
        $userRole=Auth::user()->role;
        $user=Auth::user();   

        $transaction = [];
        if ($userRole == 'admin') {
            $transaction = Transaction::with('user')->get();
        } else {
            $transaction = Transaction::where('user_id', $user->id)->with('user')->get();
        }
        
        return view('transaction.index', ['transactions' => $transaction, 'role' => $userRole]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $quantities = $request->input('quantities'); 

        $filtered = array_filter($quantities, function($qty) {
            return $qty > 0;
        });

        $total = 0;

        foreach ($filtered as $productId => $qty) {
            $product = Product::findOrFail($productId);
            $total += $product->price * $qty;
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'total_price' => $total,
        ]);

        foreach ($filtered as $productId => $qty) {
            Transaction_Product::create([
                'transaction_id' => $transaction->id,
                'product_id' => $productId,
                'qty' => $qty,
            ]);
        }

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil disimpan.');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
