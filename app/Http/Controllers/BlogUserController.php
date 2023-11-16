<?php

namespace App\Http\Controllers;
use App\Http\Service\Blog\BlogUserService;
use Illuminate\Http\Request;
use App\Http\Service\Danhmuc\DanhmucService;
use App\Http\Service\Blog\categoriesService;
use App\Http\Service\Blog\BlogService;
use App\Models\Blog;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class BlogUserController extends Controller
{
    protected $danhmuc;
    protected $blog;
    protected $categories;
    public function __construct(BlogUserService $blog,DanhmucService $danhmuc,categoriesService $categories)
    {
        $this->categories=$categories;
        $this->danhmuc=$danhmuc;
        $this->blog=$blog;
    }
    public function index(){
        return view('blog',[
            'title'=>'Blog',
            'danhmucs'=>$this->danhmuc->show(),
            'blogs'=>$this->blog->get(),
            'cates'=>$this->categories->get()
        ]);
    }
    public function show(Blog $blog){
        return view('detail',[
            'title'=>'Chi tiết blog',
            'blogs'=>$blog,
            'cates'=>$this->categories->get(),
            'danhmucs'=>$this->danhmuc->show(),

        ]);
    }
    public function userindex(){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('blog',compact('data'),[
            'title'=>'Blog',
            'danhmucs'=>$this->danhmuc->show(),
            'blogs'=>$this->blog->get(),
            'cates'=>$this->categories->get()
        ]);
    }
    public function usershow(Blog $blog){
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('detail',compact('data'),[
            'title'=>'chi tiết blog',
            'blogs'=>$blog,
            'cates'=>$this->categories->get(),
            'danhmucs'=>$this->danhmuc->show(),
        ]);
    }
}
