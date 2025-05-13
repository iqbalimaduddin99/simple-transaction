<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Transaction_Product extends Model
{
    use HasFactory;  
    
    protected $table = 'transaction__products'; // nama tabel pivot

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
