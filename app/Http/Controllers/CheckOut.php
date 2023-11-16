<?php

namespace App\Http\Controllers;
use App\Http\Service\CartService;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_property;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
class CheckOut extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService=$cartService;
    }
    public function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
    }
    public function index(){
        $property=$this->cartService->getProducts();
        $product=Product::select('id','name','price','thumb')->get();
    
       return view('carts.checkout',[
        'title'=>'thanh toán',
        'propertys'=>$property,
            'products'=>$product,
            'carts'=>Session::get('carts'),

       ]);
    }
    public function indexuser(){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $property=$this->cartService->getProducts();
        $product=Product::select('id','name','price','thumb')->get();

        return view('carts.checkoutuser',compact('data'),[
            'title'=>'thành toán',
            'propertys'=>$property,
            'products'=>$product,
            'carts'=>Session::get('carts'),
            
        ]);
    }
    public function show(Request $request){
        $total=$request->input('total');
        if($request->input('id_payment')==1){
            $contents=Session::get('carts');
        #order
        $tg = Carbon::now('Asia/Ho_Chi_Minh');
        $order_data=array();
        $order_data['id_user']=$request->input('id_user');
        $order_data['id_voucher']=$request->input('id_voucher');
        $order_data['total']=$request->input('total');
        $order_data['total_sale']=$request->input('total_sale');
        $order_data['status']=$request->input('status');
        $order_data['name']=$request->input('name');
        $order_data['address']=$request->input('address');
        $order_data['phone']=$request->input('phone');
        $order_data['email']=$request->input('email');
        $order_data['note']=$request->input('note');
        $order_data['time']=$request->input('time');
        $order_data['id_payment']=$request->input('id_payment');
        $order_data['time']=$tg;
        $order_id= DB::table('orders')->insertGetId($order_data);
         #order_detail
         
        foreach($contents as $key=>$content){
           $order_detail_data['id_order']=$order_id;
           $a=Product_property::select('product_id','size','color')->where('id',$key)->first();
           $b=$a->product_id;
           $size=$a->size;
           $color=$a->color;
           $order_detail_data['id_product']=$b;
           $c=Product::select('price')->where('id',$b)->first();
           $d=$c->price;
           $order_detail_data['price']=$d*$content;
           $order_detail_data['quantity']=$content;
           $order_detail_data['size']=$size;
           $order_detail_data['color']=$color;
           Order_detail::create( $order_detail_data);
        }    
        if($order_data['id_payment']==1){
            Session::forget('carts');
            Session::forget('coupon');
            return view('carts.success',[
                'title'=>'Đặt hàng thành công'
            ]);
        }
    }else if($request->input('id_payment')==2){
        $contents=Session::get('carts');
        #order
        $tg = Carbon::now('Asia/Ho_Chi_Minh');
        $order_data=array();
        $order_data['id_user']=$request->input('id_user');
        $order_data['id_voucher']=$request->input('id_voucher');
        $order_data['total']=$request->input('total');
        $order_data['total_sale']=$request->input('total_sale');
        $order_data['status']=$request->input('status');
        $order_data['name']=$request->input('name');
        $order_data['address']=$request->input('address');
        $order_data['phone']=$request->input('phone');
        $order_data['email']=$request->input('email');
        $order_data['note']=$request->input('note');
        $order_data['time']=$request->input('time');
        $order_data['id_payment']=$request->input('id_payment');
        $order_data['time']=$tg;
        $order_id= DB::table('orders')->insertGetId($order_data);
         #order_detail
         
        foreach($contents as $key=>$content){
           $order_detail_data['id_order']=$order_id;
           $a=Product_property::select('product_id','size','color')->where('id',$key)->first();
           $b=$a->product_id;
           $size=$a->size;
           $color=$a->color;
           $order_detail_data['id_product']=$b;
           $c=Product::select('price')->where('id',$b)->first();
           $d=$c->price;
           $order_detail_data['price']=$d*$content;
           $order_detail_data['quantity']=$content;
           $order_detail_data['size']=$size;
           $order_detail_data['color']=$color;
           Order_detail::create( $order_detail_data);
        }
        #momo
        $sale=$request->input('total_sale');
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = $order_id;
        if(isset($sale)==true){
            $amount=$sale;
        }else{
            $amount =$total;
        }
    
        $orderId = time() . "";
        $redirectUrl = "http://doan.test/momo";
        $ipnUrl = "http://doan.test/momo";
        $extraData = "";


            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            //dd( $signature);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            //dd($result);
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            return redirect()->to($jsonResult['payUrl']);
    }
        
    }
    public function showuser(Request $request){
        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
        }
        $total=$request->input('total');
        if($request->input('id_payment')==1){
            $contents=Session::get('carts');
        #order
        $tg = Carbon::now('Asia/Ho_Chi_Minh');
        $order_data=array();
        $order_data['id_user']=$request->input('id_user');
        $order_data['id_voucher']=$request->input('id_voucher');
        $order_data['total']=$request->input('total');
        $order_data['total_sale']=$request->input('total_sale');
        $order_data['status']=$request->input('status');
        $order_data['name']=$request->input('name');
        $order_data['address']=$request->input('address');
        $order_data['phone']=$request->input('phone');
        $order_data['email']=$request->input('email');
        $order_data['note']=$request->input('note');
        $order_data['time']=$request->input('time');
        $order_data['id_payment']=$request->input('id_payment');
        $order_data['time']=$tg;
        $order_id= DB::table('orders')->insertGetId($order_data);
         #order_detail
         
        foreach($contents as $key=>$content){
           $order_detail_data['id_order']=$order_id;
           $a=Product_property::select('product_id','size','color')->where('id',$key)->first();
           $b=$a->product_id;
           $size=$a->size;
           $color=$a->color;
           $order_detail_data['id_product']=$b;
           $c=Product::select('price')->where('id',$b)->first();
           $d=$c->price;
           $order_detail_data['price']=$d*$content;
           $order_detail_data['quantity']=$content;
           $order_detail_data['size']=$size;
           $order_detail_data['color']=$color;
           Order_detail::create( $order_detail_data);
        }    
        if($order_data['id_payment']==1){
            Session::forget('carts');
            Session::forget('coupon');
            return view('carts.success',compact('data'),[
                'title'=>'Đặt hàng thành công'
            ]);
        }
    }else if($request->input('id_payment')==2){
        $contents=Session::get('carts');
        #order
        $tg = Carbon::now('Asia/Ho_Chi_Minh');
        $order_data=array();
        $order_data['id_user']=$request->input('id_user');
        $order_data['id_voucher']=$request->input('id_voucher');
        $order_data['total']=$request->input('total');
        $order_data['total_sale']=$request->input('total_sale');
        $order_data['status']=$request->input('status');
        $order_data['name']=$request->input('name');
        $order_data['address']=$request->input('address');
        $order_data['phone']=$request->input('phone');
        $order_data['email']=$request->input('email');
        $order_data['note']=$request->input('note');
        $order_data['time']=$request->input('time');
        $order_data['id_payment']=$request->input('id_payment');
        $order_data['time']=$tg;
        $order_id= DB::table('orders')->insertGetId($order_data);
         #order_detail
         
        foreach($contents as $key=>$content){
           $order_detail_data['id_order']=$order_id;
           $a=Product_property::select('product_id','size','color')->where('id',$key)->first();
           $b=$a->product_id;
           $size=$a->size;
           $color=$a->color;
           $order_detail_data['id_product']=$b;
           $c=Product::select('price')->where('id',$b)->first();
           $d=$c->price;
           $order_detail_data['price']=$d*$content;
           $order_detail_data['quantity']=$content;
           $order_detail_data['size']=$size;
           $order_detail_data['color']=$color;
           Order_detail::create( $order_detail_data);
        }
        #momo
        $sale=$request->input('total_sale');
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = $order_id;
        if(isset($sale)==true){
            $amount=$sale;
        }else{
            $amount =$total;
        }
    
        $orderId = time() . "";
        $redirectUrl = "http://doan.test/user/momo";
        $ipnUrl = "http://doan.test//user/momo";
        $extraData = "";


            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            //dd( $signature);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            //dd( $result);
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            return redirect()->to($jsonResult['payUrl']);
    }
    }
   
        
}
