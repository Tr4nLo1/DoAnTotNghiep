<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Service\User\UserService;
use App\Jobs\SendPassword;
use Illuminate\Support\Facades\Hash;
class UserShow extends Controller
{
    protected $user;
    public function __construct(UserService $user)
    {
        $this->user=$user;
    }
    public function getAll(){
        return User::where('id_role',2)
        ->orderbyDesc('id')
        ->paginate(20);
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.users.show',compact('data'),[
            'title'=>'danh sách người dùng',
            'users'=>$this->getAll()
        ]);
    }
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.users.add',compact('data'),[
            'title'=>'Thêm người dùng',
            
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'phone'=>'required|max:10',
            'address'=>'required',
        ],
        [
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập Email',
            'email.email'=>'Vui lòng điền thông tin Email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'Password nhiều hơn 5 kí tự',
            'password.max'=>'Password ít hơn 12 kí tự',
            'phone.required'=>'vui lòng nhập số điện thoại',
            'phone.max'=>'vui lòng nhập đúng số điện thoại',
            'address.required'=>'vui lòng nhập địa chỉ'
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
    public function show(User $user){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.users.edit',compact('data'),[
            'title'=>'Chỉnh sửa người dùng:'.$user->id,
            'users'=>$user
        ]);
    }
    public function update(Request $request, User $user){
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
            'phone.required'=>'vui lòng nhập số điện thoại',
            'phone.max'=>'vui lòng nhập đúng số điện thoại',
            'address.required'=>'vui lòng nhập địa chỉ'
        ]);
        $result=$this->user->update($request,$user);
        if($result){
            return redirect('admin/user/list/');
        }

        return redirect()->back();
    }
    public function send($id="",Request $request){
        $data=User::where('id','=',$id)->first();
        $user=$data;
        $result=$this->user->senmail($request,$user);
        if($result){
            return redirect('admin/user/list/');
        }

        return redirect()->back();
    }

    
}
