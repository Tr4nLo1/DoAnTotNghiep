<?php

namespace App\Http\Service\Order;

use App\Models\Momo;
use App\Models\Order;

class orderService{
    public function OrderAll(){
        return Order::where('id_payment',1)->orderByDesc('id')->paginate(15);
    }
    public function OrderUser(){
        return Order::where('id_payment',1)->whereNotNull('id_user')->orderByDesc('id')->paginate(15);
    }
    public function OrderKH(){
        return Order::where('id_payment',1)->whereNull('id_user')->orderByDesc('id')->paginate(15);
    }
    public function getorder($data){
        return Order::where('id_user',$data->id)->orderByDesc('id')->paginate(10);
    }
    public function getOrderUserID($id){
        return Order::where('id',$id)->first();
    }
    public function DHbihuy(){
        return Order::where('id_payment',1)->orderByDesc('id')->where('status',4)->paginate(15);
    }
    public function DHxuly(){
        return Order::where('id_payment',1)->orderByDesc('id')->where('status',1)->paginate(15);
    }
    public function DHtuchoi(){
        return Order::where('id_payment',1)->orderByDesc('id')->where('status',3)->paginate(15);
    }
    public function DHdaxuly(){
        return Order::where('id_payment',1)->orderByDesc('id')->where('status',2)->paginate(15);
    }
    public function infomomo(){
        return Momo::with('getidorder')->orderByDesc('id')->paginate(15);
    }
}