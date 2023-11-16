<?php

namespace App\Http\View\Composers;

use App\Models\Product;
use App\Models\Product_property;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer{
    protected $users;
    public function __construct(){

    }
   
    public function compose(View $view)
    {
        $products=Product::select('id','name','price','thumb','danhmuc_id')->get();
        $carts = Session::get('carts');

        if(is_null($carts)) return [];

        $productId=array_keys($carts);
        $propertys= Product_property::select('id','product_id','color','size')
            ->whereIn('id', $productId)
            ->get();

        $view->with('propertys',$propertys)->with('products',$products)->with('carts', $carts);
    }
}