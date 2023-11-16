<?php

namespace App\Http\View\Composers;

use App\Models\Danhmuc;
use Illuminate\View\View;
class DanhmucComposer{
    protected $users;
    public function __construct(){

    }
   
    public function compose(View $view): void
    {
       $danhmucs= Danhmuc::select('id','name','parent_id')
       ->where('active',1)
       ->orderByDesc('id')
       ->get();
       $view->with('danhmucs',$danhmucs);
    }
}