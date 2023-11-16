<?php

namespace App\Http\Service\Blog;

use App\Models\Blog;

class BlogUserService{
    public function get(){
        return Blog::where('active',1)
        -> with('nameuser')->
        orderbyDesc('id')->paginate(5);
    }
    public function blogUser(){
        return Blog::where('active',1)
        -> with('nameuser')->
        orderbyDesc('id')->paginate(3);
    }
}