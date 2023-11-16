<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product_property extends Model
{
    use HasFactory;
    protected $fillable=[
        'color',
        'size',
        'product_id',
        'quantity'
    ];
    public function getproduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function getimg(){
        return $this->hasMany(Img::class,'property_id','id');
    }
}
