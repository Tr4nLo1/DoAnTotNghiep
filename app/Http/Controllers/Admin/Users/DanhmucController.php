<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Requests\Danhmuc\CreateFormRequest;
use App\Http\Service\Danhmuc\DanhmucService;
use App\Models\Danhmuc;

class DanhmucController extends Controller
{
    protected $danhmucService;

    public function __construct(DanhmucService $danhmucService)
    {
        $this->danhmucService=$danhmucService;        
    }

    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.danhmuc.add',compact('data'),[
            'title'=>'Thêm danh mục',
            'dms'=>$this->danhmucService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request){
        $result=$this->danhmucService->create($request);
        return redirect()->back();
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.danhmuc.list',compact('data'),[
            'title'=>'Danh sách danh mục',
            'dms'=>$this->danhmucService->getAll()
        ]);
    }
    public function show(Danhmuc $danhmuc){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.danhmuc.edit',compact('data'),[
            'title'=>'Chỉnh sửa danh mục '.$danhmuc->name,
            'dm'=>$danhmuc,
            'dms'=>$this->danhmucService->getParent()
        ]);
    }
    public function update(Danhmuc $danhmuc,CreateFormRequest $request){
        $this->danhmucService->update($request,$danhmuc);
        return redirect('/admin/danhmucs/list');
    }
    public function destroy(Request $request){
        $result=$this->danhmucService->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá danh mục thành công' 
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'xoá danh mục không thành công' 
        ]);
    }
}
