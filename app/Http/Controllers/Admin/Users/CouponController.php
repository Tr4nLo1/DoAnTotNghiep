<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CouponController extends Controller
{
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.coupon.add',compact('data'),[
            'title'=>'Thêm mã giảm giá'
        ]);
    }
    public function store(Request $request){
        $coupon=new Coupon();
        $coupon->name=$request->name;
        $coupon->code=$request->code;
        $coupon->amount=$request->amount;
        $coupon->select=$request->select;
        $coupon->number=$request->number;
        $res=$coupon->save();
        if($res){
            return back()->with('success','Thành công');
        }else{
            return back()->with('fail','Không thành công');
        }
    }
    public function index(){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $coupons=Coupon::select('id','name','code','amount','select','number')
        ->orderbyDesc('id')
        ->paginate(20);
        return view('Admin.coupon.list',compact('data'),[
            'title'=>'Danh sách mã giảm giá',
            'coupons'=>$coupons
        ]);
    }
    public function show($id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $coupon=Coupon::where('id',$id)->first();
        return view('Admin.coupon.edit',compact('data'),[
            'title'=>'Chỉnh sửa mã giảm giá ',
             'coupon'=>$coupon
        ]);
    }
    public function updatecoupon($request,$coupon){
        try{
            $coupon->fill($request->input());
            $coupon->save();
            Session::flash('success','Cập nhập voucher thành công');
        }catch(\Exception $err){
            Session::flash('error','Cập nhật voucher thất bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function update(Request $request,$id){
        $coupon=Coupon::where('id',$id)->first();
        $result=$this->updatecoupon($request,$coupon);
        if($request){
            return redirect('/admin/coupons/list');
        }
        return redirect()->back();
    }
    public function xoacoupon($request){
        $coupon=Coupon::where('id',$request->input('id'))->first();
        if($coupon){
            $coupon->delete();
            return true;
        }
        return false;
    }
    public function destroy(Request $request){
        $result=$this->xoacoupon($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công voucher'
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
