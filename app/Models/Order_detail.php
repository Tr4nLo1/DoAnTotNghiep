<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_order',
        'id_product',
        'price',
        'quantity',
        'size',
        'color',
    ];
    public function product(){
        return $this->hasOne(Product::class,'id','id_product');
    }
}
