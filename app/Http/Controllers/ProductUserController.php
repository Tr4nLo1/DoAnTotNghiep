<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\Product\ProductService;
use App\Http\Service\Properties\PropertiesService;
use App\Models\Comment;
use App\Models\Danhmuc;
use App\Models\Img;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_property;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class ProductUserController extends Controller
{
    protected $properties;
    protected $productService;
    
    public function __construct(ProductService $productService, PropertiesService $properties)
    {
        $this->properties=$properties;
        $this->productService=$productService;    
    }
    public function index($id='',$danhmuc='',$slug=''){
        $comments=Comment::where('id_product',$id)->get();
        $demcomment=$comments->count();
        $userall=User::get();
        $product=$this->productService->show($id);
        $productsMore=$this->productService->more($id,$danhmuc);
        return view('products.content',[
            'title'=>$product->name,
            'product'=>$product,
            'products'=> $productsMore,
            'properties'=>$this->properties->getidproper($id),
            'comments'=>$comments,
            'demcomment'=>$demcomment,
            'useralls'=>$userall

        ]);
    }
    public function show($id='',$danhmuc='',$slug=''){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $orderdamuas=Order::get();
        $detaildamuas=Order_detail::where('id_product',$id)->get();
        $dem=0;
        foreach($detaildamuas as $detaildamua){
            foreach($orderdamuas as $orderdamua){
                if($detaildamua->id_order==$orderdamua->id&&$orderdamua->status==2&&$orderdamua->id_user==$data->id){
                        $dem++;
                }
            }
        }
        $userdamuahang=$dem;
        $comments=Comment::where('id_product',$id)->get();
        $demcomment=$comments->count();
        $userall=User::get();
        $product=$this->productService->show($id);
        $productsMore=$this->productService->more($id,$danhmuc);
        return view('products.content',compact('data'),[
            'title'=>$product->name,
            'product'=>$product,
            'products'=> $productsMore,
            'properties'=>$this->properties->getidproper($id),
            'comments'=>$comments,
            'demcomment'=>$demcomment,
            'useralls'=>$userall,
            'userdamuahang'=>$userdamuahang

        ]);
    }
    public function getcolor($id,$color){
        $comments=Comment::where('id_product',$id)->get();
        $demcomment=$comments->count();
        $userall=User::get();
        $danhmuc=Product::select('danhmuc_id')->where('id',$id)->first();
        $a=$danhmuc->danhmuc_id;
        $b=Product_property::select('id')->where('product_id',$id)->where('color',$color)->first();
        $gan=$b->id;
        $img=Img::select('thumb')->where('property_id',$gan)->get();
        $product=Product::where('id',$id)->first();
        $sizes=Product_property::where('product_id',$product->id)->where('color',$color)->get();
        $product=$this->productService->show($id);
        $productsMore=$this->productService->more($id,$a);
        return view('products.size',[
            'title'=>$product->name,
            'product'=>$product,
            'products'=> $productsMore,
            'properties'=>$this->properties->getidproper($id),
            'sizes'=>$sizes,
            'hinhs'=>$img,
            'comments'=>$comments,
            'demcomment'=>$demcomment,
            'useralls'=>$userall

        ]);
    }
    public function getcoloruser($id,$color){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $orderdamuas=Order::get();
        $detaildamuas=Order_detail::where('id_product',$id)->get();
        $dem=0;
        foreach($detaildamuas as $detaildamua){
            foreach($orderdamuas as $orderdamua){
                if($detaildamua->id_order==$orderdamua->id&&$orderdamua->status==2&&$orderdamua->id_user==$data->id){
                        $dem++;
                }
            }
        }
        $userdamuahang=$dem;
        $comments=Comment::where('id_product',$id)->get();
        $demcomment=$comments->count();
        $userall=User::get();

        $danhmuc=Product::select('danhmuc_id')->where('id',$id)->first();
        $a=$danhmuc->danhmuc_id;
        $b=Product_property::select('id')->where('product_id',$id)->where('color',$color)->first();
        $gan=$b->id;
        $img=Img::select('thumb')->where('property_id',$gan)->get();
        $product=Product::where('id',$id)->first();
        $sizes=Product_property::where('product_id',$product->id)->where('color',$color)->get();
        $product=$this->productService->show($id);
        $productsMore=$this->productService->more($id,$a);
        return view('products.size',compact('data'),[
            'title'=>'chọn màu',
            'product'=>$product,
            'products'=> $productsMore,
            'properties'=>$this->properties->getidproper($id),
            'hinhs'=>$img,
            'sizes'=>$sizes,
            'comments'=>$comments,
            'demcomment'=>$demcomment,
            'useralls'=>$userall,
            'userdamuahang'=>$userdamuahang

        ]);
    }
    
}
