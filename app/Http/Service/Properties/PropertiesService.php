<?php

namespace App\Http\Service\Properties;

use App\Models\Img;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Product_property;
class PropertiesService{
    public function insert($request){
        //dd($request->input());
        try{
            $request->except('_token');
            Product_property::create($request->all());
            Session::flash('success','Thêm chi tiết sản phẩm thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm chi tiết sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getid(){
        return Product_property::with('getproduct')->orderByDesc('id')->get();

    }
    public function idproper($id,$color){
        return Product_property::where('product_id',$id)->where('color',$color)->orderByDesc('id')->get();
    }
    public function getcolorAll(){
        return Img::orderByDesc('id')->get();;
    }
    public function getidproper($id){
        $properties=Product_property::with('getproduct')->where('product_id',$id)->orderByDesc('id')->paginate(15);
        foreach($properties as $propertie){
            $mangmoi[]="$propertie->color";
        }if(empty($mangmoi)){
            return 0;
        }
        $daxuly=array_unique($mangmoi);
        return $daxuly;
    }
    public function update($request,$property){
        try{
            $property->fill($request->input());
            $property->save();
            Session::flash('success','Cập nhật chi tiết sản phẩm thành công');
        }catch(\Exception $err){
            Session::flash('error','Cập nhật chi tiết sản phẩm lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $properties=Product_property::where('id',$request->input('id'))->first();
        if($properties){
            $properties->delete();
            return true;
        }
        return false;
    }
    public function getsize($id,$color){
        return Product_property::where('product_id','=',$id)->where('color','=',$color)->with('getproduct')->orderByDesc('id')->paginate(15);
    }
    public function insertImg($request){
        try{
            $request->except('_token');
            Img::create($request->all());
            Session::flash('success','Thêm ảnh thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm ảnh lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    
}