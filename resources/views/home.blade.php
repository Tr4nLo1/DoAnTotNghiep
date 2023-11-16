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
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				@foreach($banners as $banner)
				<div class="item-slick1" style="background-image: url({{$banner->thumb}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									HOT 2023
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									{{$banner->name}}
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{$banner->url}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				@foreach($danhmucs as $danhmuc)
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="/template/images/banner-01.jpg" alt="IMG-BANNER">
						@if(isset($data)==false)
						<a href="/danh-muc/{{$danhmuc->id}}-{{\Str::slug($danhmuc->name,'-')}}.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						@elseif(isset($data)==true)
						<a href="/user/danh-muc/{{$danhmuc->id}}-{{\Str::slug($danhmuc->name,'-')}}.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						@endif
						<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									{{$danhmuc->name}}
								</span>

								<span class="block1-info stext-102 trans-04">
									Spring 2023
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>


	<!-- Product -->
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Store Overview
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Tất cả</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#men" role="tab">Nam</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#women" role="tab">Nữ</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-50">
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								@foreach($products as $product)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="{{$product->thumb}}" alt="IMG-PRODUCT">
											@if(isset($data)==false)
											<a href="/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
											@elseif(isset($data)==true)
											<a href="/user/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">	
											@endif
											Xêm thêm
											</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											@if(isset($data)==false)
												<a href="/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@elseif(isset($data)==true)	
												<a href="/user/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@endif
												{{$product->name}}
												</a>

												<span class="stext-105 cl3" style="color:red">
												{{number_format($product->price)}} VND
												</span>
											</div>

										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					
					<!-- - -->
					<div class="tab-pane fade" id="men" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								@foreach($sanphamnams as $sanphamnam)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="{{$sanphamnam->thumb}}" alt="IMG-PRODUCT">
											@if(isset($data)==false)
											<a href="/san-pham/{{$sanphamnam->id}}/{{$sanphamnam->danhmuc_id}}-{{\Str::slug($sanphamnam->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
											@elseif(isset($data)==true)
											<a href="/user/san-pham/{{$sanphamnam->id}}/{{$sanphamnam->danhmuc_id}}-{{\Str::slug($sanphamnam->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">	
											@endif
											Xêm thêm
											</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											@if(isset($data)==false)
												<a href="/san-pham/{{$sanphamnam->id}}/{{$sanphamnam->danhmuc_id}}-{{\Str::slug($sanphamnam->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@elseif(isset($data)==true)	
												<a href="/user/san-pham/{{$sanphamnam->id}}/{{$sanphamnam->danhmuc_id}}-{{\Str::slug($sanphamnam->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@endif
												{{$sanphamnam->name}}
												</a>

												<span class="stext-105 cl3" style="color:red">
												{{number_format($sanphamnam->price)}} VND
												</span>
											</div>

										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="women" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">
								@foreach($sanphamnus as $sanphamnu)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="{{$sanphamnu->thumb}}" alt="IMG-PRODUCT">
											@if(isset($data)==false)
											<a href="/san-pham/{{$sanphamnu->id}}/{{$sanphamnu->danhmuc_id}}-{{\Str::slug($sanphamnu->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
											@elseif(isset($data)==true)
											<a href="/user/san-pham/{{$sanphamnu->id}}/{{$sanphamnu->danhmuc_id}}-{{\Str::slug($sanphamnu->name),'-'}}.html" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">	
											@endif
											Xêm thêm
											</a>
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
											@if(isset($data)==false)
												<a href="/san-pham/{{$sanphamnu->id}}/{{$sanphamnu->danhmuc_id}}-{{\Str::slug($sanphamnu->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@elseif(isset($data)==true)	
												<a href="/user/san-pham/{{$sanphamnu->id}}/{{$sanphamnu->danhmuc_id}}-{{\Str::slug($sanphamnu->name),'-'}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
												@endif
												{{$sanphamnu->name}}
												</a>

												<span class="stext-105 cl3" style="color:red">
												{{number_format($sanphamnu->price)}} VND
												</span>
											</div>

										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<!-- - -->
					
				</div>
			</div>
		</div>
	</section>

	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Our Blogs
				</h3>
			</div>

			<div class="row">
				@foreach($blogs as $blog)
				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							@if(isset($data)==false)
							<a href="/blog/{{$blog->id}}">
								@elseif(isset($data)==true)
								<a href="/user/blog/{{$blog->id}}">
								@endif
								<img src="{{$blog->thumb}}" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
									{{$blog->nameuser->name}}  
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
									{{$blog->created_at->format('d/m/Y')}}
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
							@if(isset($data)==false)
								<a href="/blog/{{$blog->id}}" class="mtext-101 cl2 hov-cl1 trans-04">
								@elseif(isset($data)==true)
								<a href="/user/blog/{{$blog->id}}" class="mtext-101 cl2 hov-cl1 trans-04">
								@endif
								{{$blog->name}}
								</a>
							</h4>

							
						</div>
					</div>
				</div>
				@endforeach
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
	

    @include('footer')

</body>
</html>