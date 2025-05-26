<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_id',
        'quantity',
        'unit_amount',
        'total_amount'
    ];

    public function order(){
        return $this->belongsTo(order::class);
    }

    public function produk(){
        return $this->belongsTo(produk::class);
    }
}
