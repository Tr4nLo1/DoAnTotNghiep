<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use App\Http\Service\Properties\PropertiesService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use App\Http\Service\Product\ProductService;
use App\Models\Img;
use App\Models\Product_property;

class ProductProperticontroller extends Controller
{
    protected $properties;
    protected $product;
    public function __construct(PropertiesService $properties,ProductService $product)
    {
        $this->properties=$properties;
        $this->product=$product;
    }
    
    public function create(Product $product){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.properties.add',compact('data'),[
            'title'=>'Thêm chi tiết sản phẩm',
            'products'=>$product
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'color'=>'required',
            'size'=>'required'
        ]);
        $this->properties->insert($request);
        return redirect()->back();
    }
    public function index(Product $product){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.properties.list',compact('data'),[
            'title'=>'Danh sách chi tiết sản phẩm',
            'products'=>$product,
            'properties'=>$this->properties->getid(),
            'imgs'=>$this->properties->getcolorAll()
        ]);
    }
    public function show(Product_property $property){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.properties.edit',compact('data'),[
            'title'=>'Chỉnh sửa chi tiết sản phẩm :'.$property->product_id,
            'propertys'=>$property
        ]);
    }
    public function update(Request $request, Product_property $property){
        $this->validate($request,[
            'color'=>'required',
            'size'=>'required'
        ],[
           'color.required' =>'Không để trống màu sản phẩm',
           'size.required'=>'không để trống size sản phẩm'
        ]);
        $result=$this->properties->update($request,$property);
        if($result){
            return redirect('admin/properties/list/'.$property->product_id,);
        }

        return redirect()->back();
    }
    public function destroy(Request $request){
        $result=$this->properties->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá chi tiết sản phẩm thành công'
            ]);
        }
        return response()->json(['error'=>true]);
    }
    public function createcolor($id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
         $a=Product_property::where('id','=',$id)->first();
         $b=Img::select('thumb')->where('property_id',$id)->count();
        return view('Admin.imgcolor.add',compact('data'),[
            'title'=>'Thêm ảnh cho sản phẩm',
            'propertys'=>$a,
            'slanh'=>$b
        ]);
    }
    public function storecolor(Request $request){
        $this->validate($request,[
            'thumb'=>'required',
        ],[
           'thumb.required' =>'vui long chon anh',
        ]);
        $this->properties->insertImg($request);
        return redirect()->back();
    }
}
