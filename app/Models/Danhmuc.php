<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'parent_id',
        'description',
        'content',
        'active'
    ];
    public function products(){
        return $this->hasMany(Product::class,'danhmuc_id','id');
    }
}
