<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'thumb',
        'content',
        'categories_id',
        'id_user',
        'active'
    ];
    public function nameuser(){
        return $this->hasOne(User::class,'id','id_user');
    }
    public function namecate(){
        return $this->hasMany(categories::class,'id','categories_id');
    }
}
