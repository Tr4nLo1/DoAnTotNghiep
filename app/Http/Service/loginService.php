<?php 
namespace App\Http\Service;
use App\Models\User;
class loginService{
    public function getUser(){
        return User::where('name')->get();
    }
}