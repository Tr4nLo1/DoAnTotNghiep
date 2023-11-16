<?php

namespace App\Http\Service\Blog;

use App\Models\Blog;
use App\Models\categories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogService{
    public function insert($request){
         //dd($request->input());
        try{
            #$request->except('_token');
            Blog::create($request->input());
            Session::flash('success','Thêm blog mới thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm blog lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getAll(){
        return categories::orderbyDesc('id');
    }
    public function get(){
        return Blog::with('nameuser')->orderByDesc('id')->paginate(15);
    }
    public function getname(){
        return categories::with('getnamecate')->orderByDesc('id')->paginate(15);
    }
    public function update($request,$blog){
        try{
            $blog->fill($request->input());
            $blog->save();
            Session::flash('success','cập nhật blog thành công');
        }catch(\Exception $err){
            Session::flash('error','cập nhật blog không thành công');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request){
        $blog=Blog::where('id',$request->input('id'))->first();
        if($blog){
            $blog->active=0;
            $blog->save();
            // $path=str_replace('storage','public',$blog->thumb);
            // Storage::delete($path);
            // $blog->delete();
            return true;
        }
        return false;
    }
}