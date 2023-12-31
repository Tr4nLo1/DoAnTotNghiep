<?php
namespace App\Http\Service;

class UploadService{
    public function store($request){

        if($request->hasFile('file')){
            try{
                $name = $request->file('file')->getClientOriginalName();
                $pathFull='uploads/'.date("y/m/d");
                $request->file('file')->storeAs(
                    'public/'. $pathFull, $name
                );
                return '/storage/'.$pathFull.'/'.$name;
            }catch(\Exception $error){
                return false;
            }
        }
    }
}