<?php 

namespace App\Http\Service\Product;

use App\Models\Product;

class ProductUserService{
    public function get(){
        return Product::select('id','name','price','thumb','danhmuc_id')->where('active',1)->orderByDesc('id')->get();
    }
    public function getProductMen(){
        return Product::select('id','name','price','thumb','danhmuc_id')->where('danhmuc_id',3)->orderByDesc('id')->get();
    }
    public function getProductWomen(){
        return Product::select('id','name','price','thumb','danhmuc_id')->where('danhmuc_id',6)->orderByDesc('id')->get();
    }
}