<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionProduct;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_name',
        'price',
        'photo_url',
        'desc'
    ];
        
    public function Transaction_Product()
    {
        return $this->hasMany(Transaction_Product::class, 'product_id');
    }
}
