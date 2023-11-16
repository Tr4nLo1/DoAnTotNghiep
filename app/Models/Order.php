<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_user',
        'id_voucher',
        'total',
        'total_sale',
        'status',
        'time',
        'address',
        'name',
        'phone',
        'email',
        'note',
        'id_payment',
    ];
    protected $primaryKey = 'id';
    protected $table = 'orders';
    public function getorder(){
        return $this->hasMany(Order_detail::class,'id_order','id');
    }
}
