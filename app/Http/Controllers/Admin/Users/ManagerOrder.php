<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Service\Order\orderService;
use App\Models\Coupon;
use App\Models\Momo;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product_property;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class ManagerOrder extends Controller
{
    protected $order;
    public function __construct(orderService $order)
    {
        $this->order=$order;
    }
    public function ordercanceled(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.ordercanceled',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng bị huỷ',
            'dhbihuys'=>$this->order->DHbihuy(),


        ]);
    }
    public function ordersprocessed(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.ordersprocessed',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng đã được xử lý',
            'dhdaxulys'=>$this->order->DHdaxuly()
        ]);
    }
    public function orderrefused(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.orderrefused',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng bị từ chối',
            'dhtuchois'=>$this->order->DHtuchoi(),
        ]);
    }
    public function arebeingprocessed(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.arebeingprocessed',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng đang chờ xử lý',
            'dhxulys'=>$this->order->DHxuly(),
        ]);
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.order',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng',
            'orders'=>$this->order->OrderAll(),
        ]);
    }
    public function managerorderuser(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('orderuser',compact('data'),[
            'title'=>'Danh sách đơn đặt hàng',
            'orders'=>$this->order->getorder($data),
        ]);
    }
    public function show(Order $orders,$id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $a=$this->order->getOrderUserID($id);
        return view('Admin.managerorder.detail',compact('data'),[
            'title'=>'chi ttiết đơn hàng'.$orders->name,
            'orderdetails'=>$a,
            'details'=>$a->getorder()->with('product')->get()

        //     'carts'=>$orders->carts()->with(['product'=>function($query){
        //         $query->select('id','name','thumb');
        // }])->get(),
        ]);

    }
    public function showuser(Order $orders,$id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        
        $a=Order::where('id',$id)->where('id_user',$data->id)->first();
        if($a==null){
            return redirect()->back();
        }else{
            return view('orderdetailuser',compact('data'),[
                'title'=>'chi ttiết đơn hàng'.$orders->name,
                'orderdetails'=>$a,
                'details'=>$a->getorder()->with('product')->get()
            ]);
        }
        
    }
    public function orderdelete($id){
        $status=4;
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        
        $a=Order::where('id',$id)->where('id_user',$data->id)->first();
        $a->status=$status;
        $a->save();
        return redirect('/user/order');
    }
    public function cancelorder($id){
        $status=3;
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        
        $a=Order::where('id',$id)->first();
        $a->status=$status;
        $a->save();
        return redirect('/admin/managerorder');
    }
    public function successorder($id){
        $coupons=Coupon::get();
        $properties=Product_property::get();
        $order=Order::where('id',$id)->first();
        $orderid=$order->id;
        $details=Order_detail::where('id_order',$orderid)->get();
        if($order->id_voucher==null){
            foreach($details as $key=>$detail){
                foreach($properties as $propertie){
                    if($detail->id_product==$propertie->product_id && $detail->size==$propertie->size && $detail->color==$propertie->color){
                        $propertie->quantity=$propertie->quantity-$detail->quantity;
                        $propertie->save();
                    }
                }
            }
        }else{
            foreach($coupons as $coupon){
                if($coupon->id==$order->id_voucher){
                    $coupon->amount= $coupon->amount-1;
                    $coupon->save();
                }
            }
            foreach($details as $key=>$detail){
                foreach($properties as $propertie){
                    if($detail->id_product==$propertie->product_id && $detail->size==$propertie->size && $detail->color==$propertie->color){
                        $propertie->quantity=$propertie->quantity-$detail->quantity;
                        $propertie->save();
                    }
                }
            }
        }
        $order->status=2;
        $order->save();
        return redirect('/admin/managerorder');
    }
    #show momo
    public function showmomo(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.managerorder.momo',compact('data'),[
            'title'=>'Danh sách đơn hàng thanh toán bằng momo',
            'momos'=>$this->order->infomomo(),
        ]);
    }
    public function detailmomo(Order $orders,$id){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $a=$this->order->getOrderUserID($id);
        return view('Admin.managerorder.momodetail',compact('data'),[
            'title'=>'chi tiết đơn hàng'.$orders->name,
            'orderdetails'=>$a,
            'details'=>$a->getorder()->with('product')->get()

        //     'carts'=>$orders->carts()->with(['product'=>function($query){
        //         $query->select('id','name','thumb');
        // }])->get(),
        ]);
    }
    public function successordermomo($id){
        $coupons=Coupon::get();
        $properties=Product_property::get();
        $order=Order::where('id',$id)->first();
        $orderid=$order->id;
        $details=Order_detail::where('id_order',$orderid)->get();
        if($order->id_voucher==null){
            foreach($details as $key=>$detail){
                foreach($properties as $propertie){
                    if($detail->id_product==$propertie->product_id && $detail->size==$propertie->size && $detail->color==$propertie->color){
                        $propertie->quantity=$propertie->quantity-$detail->quantity;
                        $propertie->save();
                    }
                }
            }
        }else{
            foreach($coupons as $coupon){
                if($coupon->id==$order->id_voucher){
                    $coupon->amount= $coupon->amount-1;
                    $coupon->save();
                }
            }
            foreach($details as $key=>$detail){
                foreach($properties as $propertie){
                    if($detail->id_product==$propertie->product_id && $detail->size==$propertie->size && $detail->color==$propertie->color){
                        $propertie->quantity=$propertie->quantity-$detail->quantity;
                        $propertie->save();
                    }
                }
            }
        }
        $order->status=2;
        $order->save();
        return redirect('/admin/managerorder/momo');
    }
    public function cancelordermomo($id){
        $status=3;
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        
        $a=Order::where('id',$id)->first();
        $a->status=$status;
        $a->save();
        return redirect('/admin/managerorder/momo');
    }
    public function timkiem(Request $request){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $keywords=$request->input('searchemail');
        $search_email=Order::where('email','like','%'.$keywords.'%')->paginate(12);
        return view('Admin.managerorder.search',compact('data'),[
            'title'=>'tìm kiếm sản phẩm',
            'search_emails'=>$search_email,
        ]);
    }
    public function timkiemmomo(Request $request){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $keywords=$request->input('searchemail');
        $search_email=Order::where('email','like','%'.$keywords.'%')->paginate(12);
        $getall=Momo::paginate(12);
        return view('Admin.managerorder.searchmomo',compact('data'),[
            'title'=>'tìm kiếm sản phẩm',
            'search_emails'=>$search_email,
            'momos'=>$getall
        ]);
    }
   
}
