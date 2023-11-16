<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Service\Banner\BannerService;
use App\Models\Banner;
use App\Models\User;
class BannerController extends Controller
{
    protected $banner;
    public function __construct(BannerService $banner)
    {
        $this->banner=$banner;
    }
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.banner.add',compact('data'),[
            'title'=>'Thêm quảng cáo'
            
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
            'url'=>'required'
        ]);
        $this->banner->insert($request);
        return redirect()->back();
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.banner.list',compact('data'),[
            'title'=>'Danh sách quảng cáo',
            'banners'=>$this->banner->get()
        ]);
    }
    public function show(Banner $banner){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.banner.edit',compact('data'),[
            'title'=>'Chỉnh sửa quảng cáo ',
            'banners'=>$banner
        ]);
    }
    public function update(Request $request, Banner $banner){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
            'url'=>'required',
        ]);
        $result=$this->banner->update($request,$banner);
        if($request){
            return redirect('/admin/banners/list');
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $result=$this->banner->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công banner'
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
