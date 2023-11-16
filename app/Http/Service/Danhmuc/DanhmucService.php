<?php

namespace App\Http\Service\Danhmuc;
use App\Models\Danhmuc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class DanhmucService{
    public function getParent(){
        return Danhmuc::where('parent_id',0)->get();
    }
    public function getAll(){
        return Danhmuc::orderbyDesc('id')->paginate(20);
    }
    public function create($request){
        try{
            Danhmuc::create([
             'name'=>(string)$request->input('name'),
             'parent_id'=>(string)$request->input('parent_id'),
             'description'=>(string)$request->input('description'),
             'content'=>(string)$request->input('content'),
             'active'=>(string)$request->input('active'),
         ]);
         Session::flash('success','Tạo danh mục thành công');
        }catch(\Exception $err){
             Session::flash('error',$err->getMessage());
             return false;
        }
        return true;
     }
     public function update($request,$danhmuc):bool{
        if($request->input('parent_id')!=$danhmuc->id){
            $danhmuc->parent_id=(int)$request->input('parent_id');
        }
        $danhmuc->name=(string)$request->input('name');
        
        $danhmuc->description=(string)$request->input('description');
        $danhmuc->content=(string)$request->input('content');
        $danhmuc->active=(string)$request->input('active');
        $danhmuc->save();
        Session::flash('success','Cập nhật danh mục thành công');
        return true;
     }
     public function destroy($request){
        $id=(int)$request->input('id');
        $danhmuc=Danhmuc::where('id',$request->input('id'))->first();
        if($danhmuc){
            return Danhmuc::where('id',$id)->orwhere('parent_id',$id)->delete();
        }
        return false;
     }
     public function show(){
        return Danhmuc::select('name','id')
        ->where('parent_id',0)
        ->orderByDesc('id')
        ->get();
     }
     public function getId($id){
        if($id==1){
            return Danhmuc::where('id',3)->where('active',1)->firstOrFail();
        }else if($id==2){
            return Danhmuc::where('id',6)->where('active',1)->firstOrFail();
        }else
        return Danhmuc::where('id',$id)->where('active',1)->firstOrFail();
     }
     public function getProduct($danhmuc,$request){
        $query = $danhmuc->products()
        ->select('id','name','price','thumb','danhmuc_id')
        ->where('active',1);
        if($request->input('price')){
            $query->orderBy('price',$request->input('price'));
        }
        return $query
        ->orderByDesc('id')
        ->paginate(12)
        ->withQueryString();
     }
}