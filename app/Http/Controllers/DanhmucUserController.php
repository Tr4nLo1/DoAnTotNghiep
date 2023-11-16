<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Service\Danhmuc\DanhmucService;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
class DanhmucUserController extends Controller
{
    protected $danhmucService;
    public function __construct(DanhmucService $danhmucService)
    {
        $this->danhmucService=$danhmucService;    
    }
    public function index(Request $request,$id,$slug = ''){
        $danhmuc=$this->danhmucService->getId($id);
        $products=$this->danhmucService->getProduct($danhmuc,$request);
        if($id==1){
            return view('danhmuc',[
                'title'=>'Sản phẩm nam',
                'products'=>$products,
                'danhmuc'=>$danhmuc
            ]);
        }else if($id==2){
            return view('danhmuc',[
                'title'=>'sản phẩm nữ',
                'products'=>$products,
                'danhmuc'=>$danhmuc
            ]);
        }else
        return view('danhmuc',[
            'title'=>$danhmuc->name,
            'products'=>$products,
            'danhmuc'=>$danhmuc
        ]);
    }
    public function show(Request $request,$id,$slug = ''){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $danhmuc=$this->danhmucService->getId($id);
        $products=$this->danhmucService->getProduct($danhmuc,$request);
        if($id==1){
            return view('danhmuc',compact('data'),[
                'title'=>'Sản phẩm nam',
                'products'=>$products,
                'danhmuc'=>$danhmuc
            ]);
        }else if($id==2){
            return view('danhmuc',compact('data'),[
                'title'=>'sản phẩm nữ',
                'products'=>$products,
                'danhmuc'=>$danhmuc
            ]);
        }else
        return view('danhmuc',compact('data'),[
            'title'=>$danhmuc->name,
            'products'=>$products,
            'danhmuc'=>$danhmuc
        ]);
    }
    public function danhgia(Request $request,$id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $tg = Carbon::now('Asia/Ho_Chi_Minh');
        $comment= new Comment();
        $comment->comment=$request->input('comment');
        $comment->id_user=$request->input('id_user');
        $comment->date=$tg;
        $comment->id_product=$id;
        $comment->save();
        return redirect('/home');
    }
    
}
