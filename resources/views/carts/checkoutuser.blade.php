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
    <div class="col-md-8 col-lg-9 p-b-80" style=" margin: auto;width: 50%;border: 3px ;padding: 10px;">
					<div class="p-r-45 p-r-0-lg" style="  text-align: center;">
						<!--  -->
						@php $total=0; @endphp
						   @include('admin.alert')
							
						<!--  -->
						<div class="p-t-140">
							<h5 class="mtext-113 cl2 p-b-12">
								Thanh toán đơn hàng
							</h5>

							<p class="stext-107 cl6 p-b-40">
                            Thông tin đơn hàng
							</p>

							<form action="" method="post">
                            <div class="bor19 m-b-20" >
                            <table class="table-shopping-cart">
                            <tbody>
                            <tr class="table_head" >
									<th  style="width: 50px;">Product</th>
									<th   style="width: 150px;">Name</th>
									<th  style="width: 120px;">Price</th>
									<th  style="width: 140px;">Quantity</th>
									<th  style="width: 130px;">Total</th>
                                    <th   style="width: 80px;">Size</th>
                                    <th style="width: 80px;">Color</th>
									<th  style="width: 80px;">&nbsp;</th>
								</tr>
                                @foreach($propertys as $key=>$property)
                                @foreach($products as $key=>$product)
                                @if($property->product_id==$product->id)
								@php
								$price=$product->price;
								$priceEnd = $price*$carts[$property->id];
								$total +=  $priceEnd;
								@endphp
                                <div class="bor19 m-b-20" style="border: 0px">
									<tr>
                                        <td><img src="{{$product->thumb}}" alt="IMG" style="width: 60px;position: relative;margin-right: 20px;cursor: pointer;"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{ number_format($product->price, 0,'','.')}}VND</td>
                                        <td>{{$carts[$property->id]}}</td>
                                        <input type="hidden" name="num_product[{{$property->id}}]" value="{{$carts[$property->id]}}" readonly>
                                        <td>{{ number_format($priceEnd, 0,'','.')}}VND</td>
                                        <td>{{ $property->size}}</td>
                                        <td>{{ $property->color}}</td>
                                    </tr>
								</div>
								
                                @endif
                                @endforeach
                                @endforeach
                                </tbody>
							</table>
                            <div style="font-size: 14.5px; color: #333;margin-left:380px;">Total:{{ number_format($total, 0,'','.')}} VND</div>
                            <input type="hidden" name="total" value="{{$total}}">
                            <input type="hidden" name="status" value="1">
                            @if(Session::get('coupon'))
							<div style="font-size: 14.5px; color: #333;margin-left:380px;">
								@foreach(Session::get('coupon') as $key=>$cou)
										@if($cou['select']==1)
										Discount code: {{$cou['number']}} %
										<p>
										
											@php
												$total_coupon=($total*$cou['number'])/100;
												echo '<p>Total discount:'.number_format($total_coupon, 0,'','.').' VND</p>';
											@endphp
                                          <input type="hidden" name="id_voucher" value="{{$cou['id']}}">
										</p>
										<p>Total discount:{{ number_format($total-$total_coupon, 0,'','.')}} VND</p>
                                        <input type="hidden" name="total_sale" value="{{$total-$total_coupon}}">
										@elseif($cou['select']==2)
										Discount code: {{ number_format($cou['number'], 0,'','.')}} VND
										<p>
											@php
												$total_coupon=($total-$cou['number']);
												
											@endphp
                                            <input type="hidden" name="id_voucher" value="{{$cou['id']}}">
										</p>
										<p>Total discount:{{ number_format($total_coupon, 0,'','.')}} VND</p>
                                        <input type="hidden" name="total_sale" value="{{$total_coupon}}">
										@endif
								@endforeach
								</div>
							@endif


                            </div>

								<div class="bor19 m-b-20" >
									<input class="stext-111 cl2 plh3 size-124 p-lr-18" type="text" name="name" placeholder="Name" value="{{$data->name}}" style="min-height: 50px;">
								</div>
                                <input type="hidden" name="id_user"  value="{{$data->id}}">
								<div class="bor19 m-b-20" >
									<input class="stext-111 cl2 plh3 size-124 p-lr-18" type="text" name="address" placeholder="address" value="{{$data->address}}" style="min-height: 50px;">
								</div>

								<div class="bor19 m-b-20" >
									<input class="stext-111 cl2 plh3 size-124 p-lr-18" type="number" name="phone" placeholder="phone" value="{{$data->phone}}" style="min-height: 50px;">
								</div>
                                <div class="bor19 m-b-20" >
									<input class="stext-111 cl2 plh3 size-124 p-lr-18" type="email" name="email" placeholder="email" value="{{$data->email}}" style="min-height: 50px;">
								</div>
                                <div class="bor19 m-b-20" >
									<div style="font-size: 16px; color: #333;margin-right:500px;">
                                    <label><input style="margin-left: 10px;" type="radio" name="id_payment" value="1" placeholder="email" > Thanh toán tiền mặt</label><br>
                                	<label><input type="radio" name="id_payment" value="2" placeholder="email"> Thanh toán momo</label>
									</div>
                              
								</div>
                                <div class="bor19 m-b-20">
									<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="note" placeholder="Comment..."></textarea>
								</div>
								<button type="submit" style=" margin: auto;width: 50%;border: 3px;padding: 10px;" class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
									Thanh Toán
								</button>
                                @csrf
							</form>
						</div>
					</div>
				</div>
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