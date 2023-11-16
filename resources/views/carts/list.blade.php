<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="animsition" style="font-weight: 600;">


	<!-- Header -->
	@include('header')

	<!-- Cart -->
	@include('cart')


	<!-- breadcrumb -->

	<!-- Shoping Cart -->
	<form class="bg0 p-t-130 p-b-85" method="post">
    @if(count($propertys)!=0)
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
						@php $total=0; @endphp
						   @include('admin.alert')
							<table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
									<th class="column-1" style="width: 50px;">Product</th>
									<th class="column-2"  style="width: 150px;">Name</th>
									<th class="column-3" style="width: 120px;">Price</th>
									<th class="column-4" style="width: 140px;">Quantity</th>
									<th class="column-5" style="width: 130px;">Total</th>
                                    <th class="column-6"  style="width: 80px;">Size</th>
                                    <th class="column-7" style="width: 80px;">Color</th>
									<th class="column-8" style="width: 80px;">&nbsp;</th>
								</tr>
          
                                @foreach($propertys as $key=>$property)
                                @foreach($products as $key=>$product)
                                @if($property->product_id==$product->id)
								@php
								$price=$product->price;
								$priceEnd = $price*$carts[$property->id];
								$total +=  $priceEnd;
								@endphp	
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{$product->thumb}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$product->name}}</td>
									<td class="column-3">{{ number_format($product->price, 0,'','.')}}VND</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num_product[{{$property->id}}]" value="{{$carts[$property->id]}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									
									<td class="column-5">{{ number_format($priceEnd, 0,'','.')}}VND</td>
                                    <td class="column-6">{{ $property->size}}</td>
                                    <td class="column-7">{{ $property->color}}</td>
									<td class="column-8"><a   href="/carts/delete/{{$property->id}}">
									<iconify-icon icon="zmdi:delete" style="width: 10px;color: red;"></iconify-icon>
									</a>
								</td>
								</tr>
                                @endif
                                @endforeach
                                @endforeach
                                </tbody>
							</table>
                            
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<input type="submit" value="Apply coupont" formaction="/check-coupon" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								@csrf
								
							</div>
							
							<input type="submit" value="Update Cart" formaction="/update-cart" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            @csrf
							@if(Session::get('coupon'))
							<div>
							<input type="submit" value="delete coupon"  formaction="/delete-coupon" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
							@csrf
							</div>
							@endif
						</div>
						
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30" style="padding-bottom: 1px;">
							Cart Totals
						</h4>
						<div class="flex-w flex-t p-t-27 p-b-33" style="padding-bottom: 1px;padding-top: 1px;">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									{{ number_format($total, 0,'','.')}} VND
								</span>
							</div>
						</div>
						<div>
							@if(Session::get('coupon'))
							<div style="font-size: 14.5px; color: #333;">
								@foreach(Session::get('coupon') as $key=>$cou)
										@if($cou['select']==1)
										Discount code: {{$cou['number']}} %
										<p>
										
											@php
												$total_coupon=($total*$cou['number'])/100;
												echo '<p>Total discount:'.number_format($total_coupon, 0,'','.').' VND</p>';
												
											@endphp
										</p>
										<p>Total discount:{{ number_format($total-$total_coupon, 0,'','.')}} VND</p>
									
										@elseif($cou['select']==2)
										Discount code: {{ number_format($cou['number'], 0,'','.')}} VND
										<p>
											@php
												$total_coupon=($total-$cou['number']);
												
												
											@endphp
										</p>
										<p>Total discount:{{ number_format($total_coupon, 0,'','.')}} VND</p>
										
										@endif
								@endforeach
								</div>
							@endif
						</div>
						<div  style="padding-top: 10px;">
						@if(isset($data)==true)
						<a href="/user/check-outs" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							CHECK OUT</a>
						
						@elseif(isset($data)==false)
						<style>
							.click,.popup_box{
								position: absolute;
								top: 50%;
								left: 50%;
								transform: translate(-50%,-50%);
								background: #2981bc;
								color: white;
								font-family: arial;
								text-align: center;
								padding: 10px 15px;
								border: 1px solid #0059b3;
							}
							.popup_box{
								user-select: none;
								width: 400px;
								background: #f2f2f2;
								text-align: center;
								align-items: center;
								padding: 40px;
								border: 1px solid #b3b3b3;
								box-shadow: 0px 5px 10px rgba(0, 0, 0, .2);
								z-index: 9999;
								opacity: 0;
								pointer-events: none;
								transition: all .3s ease-in-out;
							}
							.popup_box h1{
								font-size: 30px;
								color: #1b2631;
								margin-bottom: 5px;
							}
							.popup_box label{
								font-size: 23px;
								color: #404040;
							}
							.popup_box .btns{
								margin: 40px 0 0 0;
							}
							.btns .btn1, .btns .btn2{
								background: #999999;
								color: white;
								padding: 10px 13px;
								border: 1px solid #808080;
								border-radius: 5px;
							}
							.btns .btn2{
								background: #008000;
								margin-left: 20px;
								border: 1px solid #cc0000;
							}
							.btn1:hover{
								transition: .5s;
								background: #e60000;
							}
						</style>
						<script
  src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script>
	$(document).ready(function(){
		$('.tranloi').click(function(){
			$('.popup_box').css({
				"opacity":"1","pointer-events":"auto"
			});
		});
		$('.btn1').click(function(){
			$('.popup_box').css({
				"opacity":"0","pointer-events":"none"
			});
		});
		$('.btn2').click(function(){
			$('.popup_box').css({
				"opacity":"0","pointer-events":"none"
			});
			// alert('abc asdasdasdas');
		});
	});
  </script>				
  						
						
						<a href="#" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 tranloi">CHECK OUT</a>
						
						@endif
						</div>
					</div>
				</div>
			</div>
			@if(isset($data)==false)
			<div class="popup_box">
							<h1>Bạn chưa đăng nhập!!! </h1>
							<label>Nếu bạn chưa có tài khoản</label>
							<label> bạn có thể đăng kí tài khoản <a href="/registrationuser">tại đây</a></label>
							<label>Đăng kí ngay để có thể nhận được thông tin mới nhất về sản phẩm và các ưu đãi hấp dẫn từ Shop &#128151; &#128151; &#128151;</label>
							<div class="btns">
								<a href="/check-out" class="btn1">Bỏ Qua</a>
								<a href="/loginuser" class="btn2">Login</a>
							</div>
						</div>
						@endif
		</div>
	</form>  
    					@else
                            <div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
									<th class="column-1" style="width: 50px;">Product</th>
									<th class="column-2"  style="width: 150px;">Name</th>
									<th class="column-3" style="width: 120px;">Price</th>
									<th class="column-4" style="width: 140px;">Quantity</th>
									<th class="column-5" style="width: 130px;">Total</th>
                                    <th class="column-6"  style="width: 80px;">Size</th>
                                    <th class="column-7" style="width: 80px;">Color</th>
									<th class="column-8" style="width: 80px;">&nbsp;</th>
								</tr>
								
				
                                </tbody>
								
							</table> 
							<div style="text-align: center;margin-top: 20px;">Giỏ hàng chưa có sản phẩm nào</div>  
						</div>	
					</div>
				</div>
                            @endif                    
		
	
		

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32" style="margin-top: 150px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Women
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Men
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shoes
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Watches
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns 
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

<!--===============================================================================================-->	
	@include('footer')

</body>
</html>