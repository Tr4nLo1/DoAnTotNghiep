<?php 
namespace App\Http\Service\Banner;

use App\Models\Banner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;

class BannerService{
    public function insert($request){
        try{
            #$request->except('_token');
            Banner::create($request->input());
            Session::flash('success','Thêm banner mới thành công');
        }catch(\Exception $err){
            Session::flash('error','Thêm banner lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get(){
        return Banner::orderByDesc('id')->paginate(15);
    }
    public function update($request,$banner){
        try{
            $banner->fill($request->input());
            $banner->save();
            Session::flash('success','cập nhật banner thành công');
        }catch(\Exception $err){
            Session::flash('error','cập nhật banner không thành công');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request){
        $banner=Banner::where('id',$request->input('id'))->first();
        if($banner){
            $banner->active=0;
            $banner->save();
            // $path=str_replace('storage','public',$banner->thumb);
            // Storage::delete($path);
            // $banner->delete();
            return true;
        }
        return false;
    }
    public function show(){
        return Banner::where('active',1)->orderByDesc('sort_by')->get();
    }
}