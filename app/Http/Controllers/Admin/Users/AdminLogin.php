<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Service\loginService;
use App\Models\Order;
use App\Rules\Captcha; 
use Validator;

class AdminLogin extends Controller
{
    protected $login;
    public function __construct(loginService $login)
    {
        $this->login=$login;
    }
    public function login(){
        return view('Admin.users.login',[
            'title'=>'Login'
        ]);
    }
    public function registration(){
        return view('Admin.users.registration',[
            'title'=>'Đăng kí quản trị viên'
        ]);
    }
    public function registerUser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
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
            'password.max'=>'Password ít hơn 12 kí tự'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->id_role=$request->role;
       
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
            ['id_role','=','1'],
            ])->first();
        if($user){
           if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginId',$user->id);
                return redirect('dashboard');
           }else{
            return back()->with('fail','Mật khẩu không đúng');
           }
        }else{
            return back()->with('fail','Tài khoản không tồn tại');
        }
    }
    public function dashboard(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $doanhthus=Order::where('status',2)->get();
        $tongdanhthu=0;
        foreach($doanhthus as $doanhthu){
            if($doanhthu->total_sale>0){
                $tongdanhthu += $doanhthu->total_sale;
            }else{
                $tongdanhthu += $doanhthu->total;
            }
        }
        $orderxuly=Order::where('status',1)->count();
        $useralls=User::where('id_role',2)->count();
        $orderbihuy=Order::where('status',4)->count();
        return view('Admin.home',compact('data'),[
            'title'=>'Trang chủ',
            'tongdoanhthus'=>$tongdanhthu,
            'orderxulys'=>$orderxuly,
            'userall'=>$useralls,
            'ordertuchois'=>$orderbihuy,
        ]);
    }
    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('admin/login');
        
        }
    }
}
