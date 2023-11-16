<?php

namespace App\Http\Service\Product;

use App\Models\Danhmuc;
use App\Models\Product;
use App\Models\Product_property;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductService{
    public function getproperties(){
        return Product::with('proper')->orderByDesc('id')->paginate(15);
    }
    public function getMenu(){
        return Danhmuc::where('active',1)->get();
    }
    public function getidproduct(){
        return Product::where('id',)->get();
    }
    public function insert($request){
        #dd($request->input());
        try{
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success','Thêm sản phẩm mới thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get(){
        return Product::with('menu')->orderByDesc('id')->paginate(10);
    }
    public function update($request,$product){
        try{
            $product->fill($request->input());
            $product->save();
            Session::flash('success','Cập nhật sản phẩm thành công');
        }catch(\Exception $err){
            Session::flash('error','Cập nhật sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $product=Product::where('id',$request->input('id'))->first();
        $count=Product_property::where('product_id',$request->input('id'))->count();
        if($product&&$count<=0){
            $product->active=0;
            $product->save();
            // $product->delete();
            return true;
        }
        return false;
    }
    public function show($id){
        return Product::where('id',$id)
        ->where('active',1)
        ->with('menu')
        ->firstOrFail();
    }
    public function more($id,$danhmuc){
        return Product::select('id','name','price','thumb','danhmuc_id')
        ->where('active',1)
        ->where('danhmuc_id','=',$danhmuc)
        ->where('id','!=',$id)
        ->orderByDesc('id')
        ->limit(4)
        ->get();
    }
}