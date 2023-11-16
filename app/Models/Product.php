<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'content',
        'danhmuc_id',
        'price',
        'thumb',
        'active'
    ];
    public function menu(){
        return $this->hasOne(Danhmuc::class,'id','danhmuc_id');
    }
    public function proper(){
        return $this->hasMany(Product_property::class,'product_id','id');
    }
}
