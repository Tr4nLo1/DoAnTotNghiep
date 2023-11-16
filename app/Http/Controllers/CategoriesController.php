<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Http\Service\Blog\categoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categories;
    public function __construct(categoriesService $categories)
    {
        $this->categories= $categories;
    }
    public function create(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.blog.categories.add',compact('data'),[
            'title'=>'Categories'
            
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',

        ]);
        $this->categories->insert($request);
        return redirect()->back();
    }
    public function index(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        return view('Admin.blog.categories.list',compact('data'),[
            'title'=>'Danh sách blog',
            'categories'=>$this->categories->get()
        ]);
    }
}
