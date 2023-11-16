<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Service\Blog\BlogService;
use App\Models\Blog;
use App\Models\User;
use App\Http\Service\Blog\categoriesService;
use App\Models\categories;

class Blogcontroller extends Controller
{
    protected $categories;
    protected $blog;
    public function __construct(BlogService $blog,categoriesService $categories)
    {
        $this->categories=$categories;
        $this->blog=$blog;
    }
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.blog.add',compact('data'),[
            'title'=>'Thêm bài viết',
            'categories'=>$this->categories->get()
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
            'content'=>'required',
            'categories_id'=>'required'
        ]);
        $this->blog->insert($request);
        return redirect()->back();
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.blog.list',compact('data'),[
            'title'=>'Danh sách bài viết',
            'blogs'=>$this->blog->get(),
            'cates'=>$this->categories->get()
            
        ]);
    }
    public function show(Blog $blog){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.blog.edit',compact('data'),[
            'title'=>'Chỉnh sửa bài viết ',
            'blogs'=>$blog,
            'categories'=>$this->categories->get()
        ]);
    }
    public function update(Request $request, Blog $blog){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
            'content'=>'required',
            'categories_id'=>'required'
        ]);
        $result=$this->blog->update($request,$blog);
        if($request){
            return redirect('/admin/blogs/list');
        }
        return redirect()->back();
    }
    public function destroy(Request $request){
        $result=$this->blog->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá blog thành công'
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
