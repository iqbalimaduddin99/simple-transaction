<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactionProducts()
    {
        return $this->hasMany(Transaction_Product::class, 'transaction_id');
    }
}
