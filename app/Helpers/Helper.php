<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class Helper{
    public static function danhmuc($dms,$parent_id=0,$char=''){
        $html='';
        foreach($dms as $key =>$danhmuc){
            if($danhmuc->parent_id==$parent_id){
                $html .='
                <tr>
                <td>'.$danhmuc->id.'</td>
                <td>'.$char.$danhmuc->name.'</td>
                <td>'.self::active($danhmuc->active).'</td>
                <td>'.$danhmuc->updated_at.'</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/danhmucs/edit/'.$danhmuc->id.'">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" 
                    onclick="removeRow('.$danhmuc->id.',\'/admin/danhmucs/destroy\')">
                    <i class="fas fa-trash"></i>
                </td>
                </tr>
                ';
            unset($dms[$key]);
            $html .=self::danhmuc($dms,$danhmuc->id,$char .'|--');
            }
        }
        return $html;
    }
    public static function active($active=0):string{
        return $active==0?'<span class="btn btn-danger btn-xs">NO</span>':'<span class="btn btn-success btn-xs">YES</span>';
    }
    public static function danhmucs($danhmucs,$parent_id=0){
        $html='';
        foreach($danhmucs as $key=>$danhmuc){
            if($danhmuc->parent_id== $parent_id){
                $html.='
                <li>
                    <a href="/danh-muc/'.$danhmuc->id.'-'.Str::slug($danhmuc->name,'-').'.html">
                    '.$danhmuc->name.'
                    </a>';
                if(self::isChild($danhmucs,$danhmuc->id)){
                    $html.='<ul class="sub-menu">';
                    $html.=self::danhmucs($danhmucs,$danhmuc->id);
                    $html.='</ul>';
                    
                }


                $html.='</li>
                ';
            }
        }
        return $html;
    }
    public static function userdanhmucs($danhmucs,$parent_id=0){
        $html='';
        foreach($danhmucs as $key=>$danhmuc){
            if($danhmuc->parent_id== $parent_id){
                $html.='
                <li>
                    <a href="/user/danh-muc/'.$danhmuc->id.'-'.Str::slug($danhmuc->name,'-').'.html">
                    '.$danhmuc->name.'
                    </a>';
                if(self::isChild($danhmucs,$danhmuc->id)){
                    $html.='<ul class="sub-menu">';
                    $html.=self::userdanhmucs($danhmucs,$danhmuc->id);
                    $html.='</ul>';
                    
                }


                $html.='</li>
                ';
            }
        }
        return $html;
    }
    public static function isChild($danhmucs,$id){
        foreach($danhmucs as $danhmuc){
            if($danhmuc->parent_id==$id){
                return true;
            }
        }
        return false;
    }
    public static function total($priceEnd,$total){
        
        return $total+=$priceEnd;
    }
    public static function priceEnd($price,$carts){
        return $price*$carts;
    }
    public static function totalphantram($total,$cou){
        $cou=$cou['number'];
        $html='';
            $html.=
            'Discount code:'.$cou['number'].' %
            <p>';
                    $total_coupon=($total*$cou['number'])/100;
                    '<p>Total discount:'.number_format($total_coupon, 0,'','.').' VND</p>
            </p>
            <p>Tong da giam:'. number_format($total-$total_coupon, 0,'','.').' VND</p>';
										
        return $html;
    }

    
}