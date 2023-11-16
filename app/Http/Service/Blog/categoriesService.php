<?php

namespace App\Http\Service\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\categories;

class categoriesService{
    public function insert($request){
        try{
            #$request->except('_token');
            categories::create($request->input());
            Session::flash('success','Thêm loại bài viết thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm loại bài viết lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get(){
        return categories::orderByDesc('id')->get();
    }

}