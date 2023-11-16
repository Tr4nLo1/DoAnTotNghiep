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
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-5 col-lg-12">
                    <table class="table" style=" border:1px solid black;">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                    <th style="width: 100px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <h1></h1>
                            @foreach($orders as $key=>$order)
                            <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>0{{$order->phone}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{date('d-m-Y H:i:s',strtotime($order->time))}}</td>
									
                                    @if($order->status==1&&$order->id_payment==1)
									<td class="project-state">
                          			<span class="badge badge-warning" style="font-size: medium">Đang chờ xử lý</span>
                      				</td>
                                    <td><a onclick="return confirm('Bạn có chắc là muốn huỷ đơn hàng này không?')" href="/user/order/delete/{{$order->id}}"><iconify-icon icon="iconoir:cancel"></iconify-icon></td>
                                    @elseif($order->status==2&&$order->id_payment==1)
									<td class="project-state">
                          			<span class="badge badge-success"  style="font-size: medium">Đơn hàng đã được duyệt</span>
                      				</td>
									<td></td>
									@elseif($order->status==3&&$order->id_payment==1)
									<td class="project-state">
                          			<span class="badge badge-secondary"  style="font-size: medium">Đơn hàng không được duyệt</span>
                      				</td>
									<td></td>
									@elseif($order->status==4&&$order->id_payment==1)
									<td class="project-state">
                          			<span class="badge badge-danger"  style="font-size: medium">Đơn hàng đã huỷ</span>
                      				</td>
									<td></td>
									@elseif($order->id_payment==2)
									<td class="project-state">
                          			<span class="badge badge-success"  style="font-size: medium">Đơn hàng momo đã thanh toán</span>
                      				</td>
									<td></td>
									@endif
									<td><a href="/user/details/{{$order->id}}"><iconify-icon icon="mdi:eye"></iconify-icon></td>
                            </tr>
                            @endforeach
                            </tbody>
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