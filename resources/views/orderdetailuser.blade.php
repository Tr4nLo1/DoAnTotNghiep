<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body class="animsition">
	
	<!-- Header -->
	<!-- Cart -->

	@include('header')
	@include('cart')
		

	<!-- Slider -->
	

	<!-- Banner -->
	


	<!-- Product -->
	<section class="bg0 p-t-120 p-b-150" style="margin-top: 40px;">
    <div class="#" style="margin-left: 175px;margin-bottom: 20px;">
                  <button type="button" class="btn btn-success"><a href="/user/order" style="color:white;">BACK</a></button>
                </div>
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-5 col-lg-12">
                    <table class="table" style=" border:1px solid black;">
                            <tbody>
                                <tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"  >Name</th>
									<th class="column-3" >Price</th>
									<th class="column-4" >Quantity</th>
                                    <th class="column-5"  >Size</th>
                                    <th class="column-6" >Color</th>
									<th class="column-7" >&nbsp;</th>
								</tr>
                                @foreach($details as $key=>$detail)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{$detail->product->thumb}}" style="width: 100px;" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$detail->product->name}}</td>
									<td class="column-3">{{ number_format($detail->product->price, 0,'','.')}}VND</td>
									<td class="column-4">{{$detail->quantity}}</td>
                                    <td class="column-5">{{$detail->size}}</td>
                                    <td class="column-6">{{$detail->color}}</td>
									
								</tr>

                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right">Total</td>
                                    <td>{{number_format($orderdetails->total, 0,'','.')}}VND</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total sale</td>
                                    <td>{{number_format($orderdetails->total_sale, 0,'','.')}}VND</td>
                                </tr>
                                </tbody>
							
                            </div>
                        </table>
                       
                    </div>



				<div class="col-11 col-md-7 col-lg-12 m-lr-auto">
					<button type="button" class="btn btn-success"><a href="/user/setting/{{$data->id}}" style="color:white;"><iconify-icon icon="zmdi:account-box-o"></iconify-icon> Sửa thông tin</a></button>
                <button type="button" class="btn btn-success"><a href="/user/password/{{$data->id}}" style="color:white;"><iconify-icon icon="zmdi:edit"></iconify-icon> Đổi mật khẩu</a></button>
                <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc là muốn xoá tài khoản này không?')" href="/user/delete/{{$data->id}}"  style="color:white;"><iconify-icon icon="zmdi:delete"></iconify-icon> Xoá tài khoản</a></button>
			</div>
		</div>
	</section>	


	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
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

			
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>


    @include('footer')

</body>
</html>