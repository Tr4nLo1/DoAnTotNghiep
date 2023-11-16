<?php

namespace App\Http\Service\User;

use App\Jobs\SendPassword;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService{
    public function update($request,$user){
        try{
           
            $user->fill($request->input());
            $user->save();
            Session::flash('success','Cập nhật user thành công');
        }catch(\Exception $err){
            Session::flash('error','Cập nhật user lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function updateuser($request,$user){
        try{
            $user->fill($request->input());
            $user->password=Hash::make($request->input('password'));
            $user->save();
            Session::flash('success','đổi mật khẩu thành công');
        }catch(\Exception $err){
            Session::flash('error','đổi mặt khẩu thật bại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function deteleuser($request,$user){
        $delete=0;
        try{
            $user->fill($request->input());
            $user->active=$delete;
            $user->save();
            Session::flash('success','xoá thành công');
        }catch(\Exception $err){
            Session::flash('error','xoá user lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function getuser($id){
        return User::where('id','=',$id)->get();
    }
    public function senmail($request,$user){
        $newpass="123456";
        try{
            $user->fill($request->input());
            $user->password=Hash::make( $newpass);
            $user->save();
            Session::flash('success','đã gữi mail cho user thành công');
            #Queue
            SendPassword::dispatch($user->email)->delay(now()->addSecond(5));
        }catch(\Exception $err){
            Session::flash('error','gửi mail cho user lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

}