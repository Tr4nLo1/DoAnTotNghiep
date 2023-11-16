<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\AdminLogin;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\Admin\Users\DanhmucController;
use App\Http\Controllers\Admin\Users\UserShow;
use App\Http\Controllers\Admin\Users\BannerController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\Blogcontroller;
use App\Http\Controllers\Admin\Users\Productcontroller;
use App\Http\Controllers\Admin\Users\ProductProperticontroller;
use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DanhmucUserController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\Admin\Users\CouponController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOut;
use App\Http\Controllers\Admin\Users\ManagerOrder;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['alreadyLoggedIn'])->group(function(){
    Route::get('/admin/login',[AdminLogin::class,'login']);
    Route::get('/admin/registration',[AdminLogin::class,'registration']);
    Route::post('/admin/register-user',[AdminLogin::class,'registerUser'])->name('register-user');
    Route::post('/admin/login-user',[AdminLogin::class,'loginUser'])->name('login-user');
});

Route::middleware(['isLoggedIn'])->group(function(){
    Route::get('/dashboard',[AdminLogin::class,'dashboard']);
    Route::get('/logout',[AdminLogin::class,'logout']);
    #danhmuc
    Route::prefix('admin/danhmucs')->group(function(){
        Route::get('add',[DanhmucController::class,'create']);
        Route::post('add',[DanhmucController::class,'store']);
        Route::get('list',[DanhmucController::class,'index']);
        Route::get('edit/{danhmuc}',[DanhmucController::class,'show']);
        Route::post('edit/{danhmuc}',[DanhmucController::class,'update']);
        Route::delete('destroy',[DanhmucController::class,'destroy']);
    });
    #user
    Route::prefix('admin/user')->group(function(){
    Route::get('add',[UserShow::class,'create']);
    Route::post('add',[UserShow::class,'store']);
    Route::get('list',[UserShow::class,'index']);
    Route::get('edit/{user}',[UserShow::class,'show']);
    Route::post('edit/{user}',[UserShow::class,'update']);
    Route::get('send/{user}',[UserShow::class,'send']);
    });
    #upload
    Route::post('/admin/upload/service',[UploadController::class,'store']);
    #banner
    Route::prefix('admin/banners')->group(function(){
        Route::get('add',[BannerController::class,'create']);
        Route::post('add',[BannerController::class,'store']);
        Route::get('list',[BannerController::class,'index']);
        Route::get('edit/{banner}',[BannerController::class,'show']);
        Route::post('edit/{banner}',[BannerController::class,'update']);
        Route::delete('destroy',[BannerController::class,'destroy']);
    });
    #blog
    Route::prefix('admin/blogs')->group(function(){
        Route::get('add',[Blogcontroller::class,'create']);
        Route::post('add',[Blogcontroller::class,'store']);
        Route::get('list',[Blogcontroller::class,'index']);
        Route::get('edit/{blog}',[Blogcontroller::class,'show']);
        Route::post('edit/{blog}',[Blogcontroller::class,'update']);
        Route::delete('destroy',[Blogcontroller::class,'destroy']);
    });
    #product
    Route::prefix('admin/products')->group(function(){
        Route::get('add',[Productcontroller::class,'create']);
        Route::post('add',[Productcontroller::class,'store']);
        Route::get('list',[Productcontroller::class,'index']);
        Route::post('list',[Productcontroller::class,'timkiemsp']);
        Route::get('edit/{product}',[Productcontroller::class,'show']);
        Route::post('edit/{product}',[Productcontroller::class,'update']);
        Route::delete('destroy',[Productcontroller::class,'destroy']);
    });
    #product_propertiy
    Route::prefix('admin/properties')->group(function(){
        Route::get('add/{product}',[ProductProperticontroller::class,'create']);
        Route::post('add/{product}',[ProductProperticontroller::class,'store']);
        Route::get('list/{product}',[ProductProperticontroller::class,'index']);
        Route::get('edit/{property}',[ProductProperticontroller::class,'show']);
        Route::post('edit/{property}',[ProductProperticontroller::class,'update']);
        Route::delete('destroy',[ProductProperticontroller::class,'destroy']);
    });
    #propertiy_img_color
    Route::prefix('admin/imgs')->group(function(){
        Route::get('add/{id}',[ProductProperticontroller::class,'createcolor']);
        Route::post('add/{id}',[ProductProperticontroller::class,'storecolor']);
    });
    #categories
    Route::prefix('admin/categories')->group(function(){
        Route::get('add',[CategoriesController::class,'create']);
        Route::post('add',[CategoriesController::class,'store']);
        Route::get('list',[CategoriesController::class,'index']);
        Route::delete('destroy',[CategoriesController::class,'destroy']);
    });
    #coupon
    Route::prefix('admin/coupons')->group(function(){
        Route::get('add',[CouponController::class,'create']);
        Route::post('add',[CouponController::class,'store']);
        Route::get('list',[CouponController::class,'index']);
        Route::get('edit/{id}',[CouponController::class,'show']);
        Route::post('edit/{id}',[CouponController::class,'update']);
        Route::delete('destroy',[CouponController::class,'destroy']);
    });
    Route::get('/admin/managerorder',[ManagerOrder::class,'index']);
    Route::post('/admin/managerorder',[ManagerOrder::class,'timkiem']);
    Route::get('/admin/managerorder/ordercanceled',[ManagerOrder::class,'ordercanceled']);
    Route::get('/admin/managerorder/ordersprocessed',[ManagerOrder::class,'ordersprocessed']);
    Route::get('/admin/managerorder/orderrefused',[ManagerOrder::class,'orderrefused']);
    Route::get('/admin/managerorder/arebeingprocessed',[ManagerOrder::class,'arebeingprocessed']);
    Route::get('/admin/managerorder/detail/{id}',[ManagerOrder::class,'show']);
    Route::get('/admin/managerorder/cancel/{id}',[ManagerOrder::class,'cancelorder']);
    Route::get('/admin/managerorder/success/{id}',[ManagerOrder::class,'successorder']);
    Route::get('/admin/managerorder/momo',[ManagerOrder::class,'showmomo']);
    Route::get('/admin/managerorder/momodetail/{id}',[ManagerOrder::class,'detailmomo']);
    Route::get('/admin/managerorder/momodetail/cancel/{id}',[ManagerOrder::class,'cancelordermomo']);
    Route::get('/admin/managerorder/momodetail/success/{id}',[ManagerOrder::class,'successordermomo']);
    Route::post('/admin/managerorder/momo',[ManagerOrder::class,'timkiemmomo']);
    

});
#user
Route::get('/',[MainUserController::class,'index']);
Route::get('/loginuser',[MainUserController::class,'login']);
Route::get('/registrationuser',[MainUserController::class,'registration']);
Route::post('/user/registration',[MainUserController::class,'registrationuser']);
Route::post('/user/loginuser',[MainUserController::class,'loginuser']);
Route::get('/home',[MainUserController::class,'home']);
Route::get('/logoutuser',[MainUserController::class,'logoutuser']);
Route::post('/service/load-product',[MainUserController::class,'loadProduct']);
Route::get('/blog',[BlogUserController::class,'index']);
Route::get('/blog/{blog}',[BlogUserController::class,'show']);
Route::get('danh-muc/{id}-{slug}.html',[DanhmucUserController::class,'index']);
Route::get('san-pham/{id}/{danhmuc}-{slug}.html',[ProductUserController::class,'index']);
Route::get('/user/danh-muc/{id}-{slug}.html',[DanhmucUserController::class,'show']);
Route::get('/user/san-pham/{id}/{danhmuc}-{slug}.html',[ProductUserController::class,'show']);
Route::get('/user/blog',[BlogUserController::class,'userindex']);
Route::get('/user/blog/{blog}',[BlogUserController::class,'usershow']);
Route::get('/user/setting',[MainUserController::class,'indexuser']);
Route::get('/user/setting/{id}',[MainUserController::class,'showuser']);
Route::post('/user/setting/{id}',[MainUserController::class,'updateuser']);
Route::get('/user/password/{id}',[MainUserController::class,'password']);
Route::post('/user/password/{id}',[MainUserController::class,'updatepassword']);
Route::get('/user/delete/{id}',[MainUserController::class,'deleteuser']);
Route::get('/san-pham/{id}/{propertie}',[ProductUserController::class,'getcolor']);
Route::get('/user/san-pham/{id}/{propertie}',[ProductUserController::class,'getcoloruser']);
Route::get('/user/order',[ManagerOrder::class,'managerorderuser']);

Route::post('/user/san-pham/{id}/{danhmuc}-{slug}.html',[DanhmucUserController::class,'danhgia']);
Route::post('/user/san-pham/{id}/{propertie}',[DanhmucUserController::class,'danhgia']);


#cart
Route::post('/add-cart',[CartController::class,'index']);
Route::post('/user/add-cart',[CartController::class,'indexuser']);
Route::get('/carts',[CartController::class,'show']);
Route::get('/user/carts',[CartController::class,'showuser']);
Route::post('/update-cart',[CartController::class,'update']);
Route::get('/carts/delete/{id}',[CartController::class,'remove']);

#coupon
Route::post('/check-coupon',[CartController::class,'check_coupon']);
Route::post('/delete-coupon',[CartController::class,'unsetcoupon']);
#checkout
Route::get('/check-out',[CheckOut::class,'index']);
Route::get('/user/check-outs',[CheckOut::class,'indexuser']);
Route::post('/check-out',[CheckOut::class,'show']);
Route::post('/user/check-outs',[CheckOut::class,'showuser']);
#managerorder
Route::get('/user/details/{id}',[ManagerOrder::class,'showuser']);
Route::get('/user/order/delete/{id}',[ManagerOrder::class,'orderdelete']);
Route::get('/search',[MainUserController::class,'search']);
Route::get('/user/search',[MainUserController::class,'searchuser']);
#momo
Route::get('/momo',[MainUserController::class,'momo']);
Route::get('user/momo',[MainUserController::class,'momouser']);


// Route::get('/login',[AdminLogin::class,'login'])->middleware('alreadyLoggedIn');
// Route::get('/registration',[AdminLogin::class,'registration'])->middleware('alreadyLoggedIn');
// Route::post('/register-user',[AdminLogin::class,'registerUser'])->name('register-user');
// Route::post('/login-user',[AdminLogin::class,'loginUser'])->name('login-user');
// Route::get('/dashboard',[AdminLogin::class,'dashboard'])->middleware('isLoggedIn');
// Route::get('/logout',[AdminLogin::class,'logout']);
// Route::get('san-pham/{id}-{slug}.html',[ProductUserController::class,'index']);