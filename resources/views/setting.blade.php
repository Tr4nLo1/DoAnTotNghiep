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
	
	<section class="bg0 p-t-75 p-b-150" style="margin-top: 40px;">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						@include('admin.alert')
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
							Thông tin user
						</h4>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" value="{{$users->name}}" name="name" placeholder="Your Name" readonly>
						</div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
						<div class="bor8 m-b-30">
						<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" value="{{$users->email}}" name="email" placeholder="Your Email" readonly>
						</div>@error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="password"  value="{{$users->password}}" readonly>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="bor8 m-b-30">
						<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="numberphone" value="0{{$users->phone}}" name="phone" placeholder="Your Phone" readonly>
						</div>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="bor8 m-b-30">
						<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" value="{{$users->address}}" type="text" name="address" placeholder="Your address" readonly>
						</div>
						<div class="bor8 m-b-30">
						@if($users->sex==1)
						<label style="margin-left: 72px;">Nam</label>
						@else
						<label style="margin-left: 72px;">Nữ</label>
						@endif
						</div>
                        <input  value="{{$users->active}}" type="hidden" id="active" name="active">
						<input type="hidden" name="id_role"  value="2">
						<div class="m-b-30">
						</div>
					</div>
				</div>

				<div class="col-11 col-md-7 col-lg-4 m-lr-auto">
                    <div class="card-footer" style="margin-top: 74px; background-color: white;">
					<button type="button" class="btn btn-success"><a href="/user/setting/{{$users->id}}" style="color:white;"><iconify-icon icon="zmdi:account-box-o"></iconify-icon> Sửa thông tin</a></button>
                <button type="button" class="btn btn-success"><a href="/user/password/{{$users->id}}" style="color:white;"><iconify-icon icon="zmdi:edit"></iconify-icon> Đổi mật khẩu</a></button>
                <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có chắc là muốn xoá tài khoản này không?')" href="/user/delete/{{$users->id}}"  style="color:white;"><iconify-icon icon="zmdi:delete"></iconify-icon> Xoá tài khoản</a></button>
						</div>
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