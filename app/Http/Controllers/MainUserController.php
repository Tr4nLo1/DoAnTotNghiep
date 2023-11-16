<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Service\loginService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Http\Service\Banner\BannerService;
use App\Http\Service\Danhmuc\DanhmucService;
use App\Http\Service\Product\ProductUserService;
use App\Http\Service\Blog\BlogUserService;
use App\Http\Service\User\UserService;
use App\Models\Coupon;
use App\Models\Momo;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_property;
use Illuminate\Console\View\Components\Alert;

class MainUserController extends Controller
{
    protected $danhmuc;
    protected $banner;
    protected $login;
    protected $product;
    protected $blog;
    protected $user;
    public function __construct(loginService $login,BannerService $banner,DanhmucService $danhmuc,ProductUserService $product,BlogUserService  $blog,UserService $user)
    {
        $this->danhmuc=$danhmuc;
        $this->login=$login;
        $this->banner=$banner;
        $this->product=$product;
        $this->blog=$blog;
        $this->user=$user;
    }
    public function index(){
        return view('home',[
            'title'=>'Shop quần áo',
            'banners'=>$this->banner->show(),
            'danhmucs'=>$this->danhmuc->show(),
            'products'=>$this->product->get(),
            'blogs'=>$this->blog->blogUser(),
            'sanphamnams'=>$this->product->getProductMen(),
            'sanphamnus'=>$this->product->getProductWomen()
        ]);
    }
    public function login(){
        return view('login',[
            'title'=>'Login'
        ]);
    }
    public function registration(){
        return view('registrationuser',[
            'title'=>'Đăng kí tài khoản'
        ]);
    }
    public function registrationuser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'phone'=>'required|max:10',
            'address'=>'required',
            'g-recaptcha-response' => 'required',
        ],
        [
            'g-recaptcha-response.required'=>'Vui lòng nhấn vào xác minh',
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập Email',
            'email.email'=>'Vui lòng điền thông tin Email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'Password nhiều hơn 5 kí tự',
            'password.max'=>'Password ít hơn 12 kí tự',
            'phone.required'=>'vui long nhap so dien thoat',
            'phone.max'=>'vui long nhap dung so dien thoat',
            'address.required'=>'vui long nhap dia chi'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->sex=$request->sex;
        $user->id_role=$request->role;
        $user->active=$request->active;
        $res=$user->save();
        if($res){
            return back()->with('success','Thành công');
        }else{
            return back()->with('fail','Không thành công');
        }
    }
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',
            'g-recaptcha-response' => 'required',
        ],[
            'g-recaptcha-response.required'=>'Vui lòng nhấn vào xác minh',
            'email.required'=>'Vui lòng nhập Email',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'Password nhiều hơn 5 kí tự',
            'password.max'=>'Password ít hơn 12 kí tự'
        ]);
        // $user=User::where('email','=',$request->email)->first();
        $user=User::where([
            ['email','=',$request->email],
            ['id_role','=','2'],
            ['active','=','1'],
            ])->first();
        if($user){
           if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('home');
           }else{
            return back()->with('fail','Mật khẩu không đúng');
           }
        }else{
            return back()->with('fail','Tài khoản không tồn tại');
        }
    }
    public function home(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('/home',compact('data'),[
            'title'=>'user',
            'banners'=>$this->banner->show(),
            'danhmucs'=>$this->danhmuc->show(),
            'products'=>$this->product->get(),
            'blogs'=>$this->blog->blogUser(),
            'sanphamnams'=>$this->product->getProductMen(),
            'sanphamnus'=>$this->product->getProductWomen()
        ]);
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            // Session::forget('loginId');
            return redirect('/loginuser');
        
        }
    }
    public function loadProduct(Request $request){
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }
    public function indexuser(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('/setting',compact('data'),[
            'title'=>'Thông tin user',
            'users'=>$data
        ]);
    }
    public function showuser(User $user){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('user.edit',compact('data'),[
            'title'=>'Chỉnh sửa thông tin user:'.$data->id,
            'users'=>$user=$data
        ]);
    }
    public function updateuser(Request $request, User $user){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required|max:10',
            'address'=>'required',
        ],
        [
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập Email',
            'password.required'=>'Vui lòng nhập password',
            'phone.required'=>'vui long nhap so dien thoat',
            'phone.max'=>'vui long nhap dung so dien thoat',
            'address.required'=>'vui long nhap dia chi'
        ]);
        $user=$data;
        $result=$this->user->update($request,$user);
        if($result){
            return redirect('/user/setting');
        }

        return redirect()->back();
    }
    public function password(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('user.password',compact('data'),[
            'title'=>'đổi mật khẩu user',
            'users'=>$data
        ]);
    }
    public function updatepassword(Request $request, User $user){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $request->validate([
            'password'=>'required|min:5|max:10',
        ],
        [
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'password tren 5 ki tu',
            'password.max'=>'password duoi 10 ki tu',
        ]);
        $user=$data;
        $result=$this->user->updateuser($request,$user);
        if($result){
            return redirect('/user/setting');
        }

        return redirect()->back();
    }

    public function deleteuser(Request $request, User $user){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $user=$data;
        $result=$this->user->deteleuser($request,$user);
        if($result){
            return redirect('/');
        }

        return redirect()->back();
    }
    public function search(Request $request){
        $keywords=$request->input('search');
        $search_product=Product::where('name','like','%'.$keywords.'%')->paginate(12);
        return view('search',[
            'title'=>'search',
            'search_products'=>$search_product,
        ]);
    }
    public function searchuser(Request $request){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $keywords=$request->input('search');
        $search_product=Product::where('name','like','%'.$keywords.'%')->paginate(12);
        return view('search',compact('data'),[
            'title'=>'search',
            'search_products'=>$search_product,
        ]);
    }
    public function insertContact($data_momo){
        return Momo::insert($data_momo);
    }
    public function momo(){
        if($_GET['message']=='Successful.'){
            Session::forget('carts');
            Session::forget('coupon');
            
            $data_momo=[
                'id_order'=>$_GET['orderInfo'],
                'partnerCode'=>$_GET['partnerCode'],
                'orderId'=>$_GET['orderId'],
                'requestId'=>$_GET['requestId'],
                'amount'=>$_GET['amount'],
                'message'=>$_GET['message'],
                'orderType'=>$_GET['orderType'],
                'transId'=>$_GET['transId'],
                'payType'=>$_GET['payType'],
                'signature'=>$_GET['signature'],
            ];
            //luu thong tin
            $result=$this->insertContact($data_momo);
            
            //goi ham de thay doi
            $coupons=Coupon::get();
            $properties=Product_property::get();
            $order=Order::where('id',$_GET['orderInfo'])->first();
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
            $thanhtoanmomo='Thanh toán momo thành công';
            return view('carts.success',[
                'title'=>'Thanh toán momo',
                'momo'=> $thanhtoanmomo
            ]);
        }else if($_GET['message']=='Transaction denied by user.'||$_GET['resultCode']==1006||$_GET['resultCode']==1002){
            $thanhtoanmomo='Thanh toán momo thất bại';
            Order::where('id',$_GET['orderInfo'])->delete();
            Order_detail::where('id_order',$_GET['orderInfo'])->delete();
        return view('carts.success',[
            'title'=>'Thanh toán momo',
            'momo'=> $thanhtoanmomo
        ]);
        }
        
    }
    public function momouser(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        if($_GET['message']=='Successful.'){
            Session::forget('carts');
            Session::forget('coupon');
            $data_momo=[
                'id_order'=>$_GET['orderInfo'],
                'partnerCode'=>$_GET['partnerCode'],
                'orderId'=>$_GET['orderId'],
                'requestId'=>$_GET['requestId'],
                'amount'=>$_GET['amount'],
                'message'=>$_GET['message'],
                'orderType'=>$_GET['orderType'],
                'transId'=>$_GET['transId'],
                'payType'=>$_GET['payType'],
                'signature'=>$_GET['signature'],
            ];
            //luu thong tin
            $result=$this->insertContact($data_momo);
            $coupons=Coupon::get();
            $properties=Product_property::get();
            $order=Order::where('id',$_GET['orderInfo'])->first();
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
            $thanhtoanmomo='Thanh toán momo thành công';
            return view('carts.success',compact('data'),[
                'title'=>'Thanh toán momo',
                'momo'=> $thanhtoanmomo
            ]);
        }else if($_GET['message']=='Transaction denied by user.'){
            $thanhtoanmomo='Thanh toán momo thất bại';
            Order::where('id',$_GET['orderInfo'])->delete();
            Order_detail::where('id_order',$_GET['orderInfo'])->delete();
        return view('carts.success',compact('data'),[
            'title'=>'Thanh toán momo',
            'momo'=> $thanhtoanmomo
        ]);
        }
    }
}
