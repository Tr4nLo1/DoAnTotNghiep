<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Service\Product\ProductService;
use App\Models\Product;
use App\Http\Service\Properties\PropertiesService;
use App\Http\Service\Danhmuc\DanhmucService;
use App\Models\Danhmuc;
use App\Models\Product_property;

class Productcontroller extends Controller
{
    protected $danhmucService;
    protected $properties;
    protected $productService;
    public function __construct(ProductService $productService,PropertiesService $properties,DanhmucService $danhmucService)
    {
        $this->danhmucService=$danhmucService; 
        $this->properties=$properties;
        $this->productService=$productService;
    }
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.product.add',compact('data'),[
            'title'=>'Thêm sản phẩm',
            'products'=>$this->productService->getMenu()
        ]);
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:products',
            'description'=>'required',
            'price' =>'required|numeric|min:0',
            'description' =>'required',
            'content'=>'required',
            'thumb'=>'required',
        ],[
            
            'name.unique'=>'tên sản phẩm không được trùng',
           'name.required' =>'vui lòng điền tên sản phẩm',
           'description.required'=>'vui lòng điền nội dung',
           'price.required' =>'vui lòng điền giá sản phẩm',
           'price.min'=>'giá sản phẩm không được phép âm',
           'description.required' =>'vui lòng điền mô tả sản phẩm',
           'content.required' =>'vui lòng điền nội dung sản phẩm',
           'thumb.required' =>'vui lòng chọn ảnh cho sản phẩm',
        ]);
        $this->productService->insert($request);
        return redirect()->back();
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $slsaphethang=Product_property::select('id','color','size','quantity','product_id')->where('quantity','<=',4)->get();
        $a=count($slsaphethang);
        return view('Admin.product.list',compact('data'),[
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->get(),
            'properties'=>$this->properties->getid(),
            'sphethangs'=>$slsaphethang,
            'dem'=>$a

        ]);
    }
    public function show(Product $product){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.product.edit',compact('data'),[
            'title'=>'Chỉnh sửa sản phẩm: '.$product->name,
            'product'=>$product,
            'danhmucs'=>$this->productService->getmenu()
        ]);
    }
    public function update(Request $request, Product $product){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[
           'name.required' =>'không để trống tên sản phẩm',
           'description.required'=>'không để trống nôi dung sản phẩm'
        ]);
        $result=$this->productService->update($request,$product);
        if($result){
            return redirect('admin/products/list');
        }

        return redirect()->back();
    }
    public function destroy(Request $request){
        $result=$this->productService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá sản phẩm thành công'
            ]);
        }
        return response()->json(['error'=>true]);
    }
    public function timkiemsp(Request $request){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $keywords=$request->input('search');
        $search_product=Product::where('name','like','%'.$keywords.'%')->paginate(12);
        return view('Admin.product.search',compact('data'),[
            'title'=>'tìm kiếm sản phẩm',
            'search_products'=>$search_product,
        ]);
    }
}
