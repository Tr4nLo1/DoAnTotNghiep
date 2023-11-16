<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\CartService;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Product_property;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService=$cartService;
    }
    public function index(Request $request){
        $result=$this->cartService->create($request);
        if($result===false){
            return redirect()->back();
        }
        return redirect('/carts');
    }
    public function indexuser(Request $request){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $result=$this->cartService->create($request);
        if($result===false){
            return redirect()->back();
        }
        return redirect('/user/carts')->with('data',$data);
    }

    public function show(){
        
        $property=$this->cartService->getProducts();
        $product=Product::select('id','name','price','thumb')->get();
    
        return view('carts.list',[
            'title'=>'giỏ hàng',
            'propertys'=>$property,
            'products'=>$product,
            'carts'=>Session::get('carts'),
     
        ]);
    }
    public function showuser(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $property=$this->cartService->getProducts();
        $product=Product::select('id','name','price','thumb')->get();
    
        return view('carts.list',compact('data'),[
            'title'=>'giỏ hàng',
            'propertys'=>$property,
            'products'=>$product,
            'carts'=>Session::get('carts'),
     
        ]);
    }
    public function update(Request $request){
        $result=$this->cartService->update($request);
        if($request===true){
            return redirect('/carts');
        }return redirect()->back();
    }
    public function remove($id=0){
        $this->cartService->remove($id);
        return redirect('/carts');
    }
    public function check_coupon(Request $request){
        $data=$request->all();
        $coupon=Coupon::where('code',$data['coupon'])->where('amount','>','0')->first();
        if($coupon){
            $count_coupon=$coupon->count();
            if($count_coupon>0){
                $coupon_session=Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable=0;
                    if($is_avaiable==0){
                        $cou[]= array(
                            'id'=>$coupon->id,
                            'code'=>$coupon->code,
                            'select'=>$coupon->select,
                            'number'=>$coupon->number
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[]= array(
                        'id'=>$coupon->id,
                        'code'=>$coupon->code,
                        'select'=>$coupon->select,
                        'number'=>$coupon->number
                    ); 
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('success','Thêm mã giảm giá thành công');
            }
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc số lượng của mã giảm giá đã hết');
        }
    }
    public function unsetcoupon(){
        $coupon=Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('success','Xoá mã giảm giá thành công');
        }
    }
}
