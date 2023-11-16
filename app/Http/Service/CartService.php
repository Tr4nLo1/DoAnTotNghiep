<?php 
namespace App\Http\Service;

use App\Models\Product;
use Illuminate\Support\Arr;
use App\Models\Product_property;
use Illuminate\Support\Facades\Session;

class CartService{
    public function create($request){
        if($request->input('property_id')<=0){
            Session::flash('error','Vui lòng chọn size cho sản phẩm');
            return false;
        }
        $id_proper=(int)$request->input('property_id');
        $qty=(int)$request->input('num-product');
        $product_id=(int)$request->input('product_id');
        $a=Product_property::select('quantity')->where('id', $id_proper)->first();
        $quantity=$a->quantity;
        
        if($qty <= 0|| $product_id<=0){
            Session::flash('error','Số lượng hoặc sản phẩm không chính xác');
            return false;
        }elseif($qty>$quantity){
            Session::flash('error','Vui lòng điền số lượng phù hợp');
            return false;
            
        }
        $carts=Session::get('carts');
        if(is_null($carts)){
            Session::put('carts',[
                $id_proper=>$qty
            ]);
            return true;
        } 
        
        $exists=Arr::exists($carts, $id_proper);
        if($exists){
            
            $carts[$id_proper]=$carts[$id_proper]+$qty;
            
            Session::put('carts',$carts);
            return true;
        }

        $carts[$id_proper]=$qty;
        Session::put('carts', $carts);
        return true;
    }
    public function getProducts(){
        $carts=Session::get('carts');
        if(is_null($carts)) return [];

        $productId=array_keys($carts);
        return Product_property::select('id','product_id','color','size')
            ->whereIn('id', $productId)
            ->get();
    }
    public function update($request){
        $as=$request->input('num_product');
        
        foreach($as as $key=>$a){
            $slhang=Product_property::select('quantity')->where('id',$key)->first();
            $quantity=$slhang->quantity;
    
        }
        if($a<=$quantity){
        Session::put('carts', $request->input('num_product'));
        return true;
        }else{
            Session::flash('error','Số lượng sản phẩm ID: '.$key.' đặt lớn hơn số lượng còn trong kho');
            return false;
        }
    }
    public function remove($id){
        $carts=Session::get('carts');
        unset($carts[$id]);
        Session::put('carts',$carts);
        return true;
    }
}