<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Momo extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_order',
        'partnerCode',
        'orderId',
        'requestId',
        'amount',
        'orderInfo',
        'orderType',
        'transId',
        'payType',
        'message',
        'signature',
    ];
    public function getidorder(){
        return $this->hasOne(Order::class,'id','id_order');
    }
}
