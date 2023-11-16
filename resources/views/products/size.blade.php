<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="animsition">
	
	<!-- Header -->
	@include('header')

	<!-- Cart -->
	@include('cart')


	<!-- breadcrumb -->
	<div class="container p-t-100">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			@if(isset($data)==false)
			<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
				@elseif(isset($data)==true)
				<a href="/home" class="stext-109 cl8 hov-cl1 trans-04">
				@endif
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			@if(isset($data)==false)
			<a href="/danh-muc/{{$product->menu->id}}-{{ \Str::slug($product->menu->name)}}.html" class="stext-109 cl8 hov-cl1 trans-04">
			@elseif(isset($data)==true)
			<a href="/user/danh-muc/{{$product->menu->id}}-{{ \Str::slug($product->menu->name)}}.html" class="stext-109 cl8 hov-cl1 trans-04">
			@endif
            {{$product->menu->name}}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				{{$product->name}}
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
                                @foreach($hinhs as $value)
								<div class="item-slick3" data-thumb="{{$value->thumb}}">
									<div class="wrap-pic-w pos-relative">
										<img src="{{$value->thumb}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="#">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
                                @endforeach
								
								
							
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
					<h4 class="mtext-105 cl2 js-name-detail p-b-14">
						
						{{$product->name}}
					</h4>
					<span class="mtext-106 cl2">
						{{number_format($product->price)}} VND
					</span>

					<p class="stext-102 cl3 p-t-23">
						{{$product->description}}
					</p>
					@include('admin.alert')
						<!--  -->
						<div class="p-t-33">
							@if(isset($data)==false)
							<form action="/add-cart" method="post">
							@else(isset($data)==true)
							<form action="/user/add-cart" method="post">
							@endif
							<div class="flex-w flex-r-m p-b-10">
							<div class="size-203 flex-c-m respon6" style="justify-content: left;">
									Color:
								</div>
								<div class="size-204 respon6-next">	
									@if($properties==0)
									chua co mau sac
									@elseif($properties!=0)
									@foreach($properties as $key=> $propertie)
									@if(isset($data)==false)
									<a href="/san-pham/{{$product->id}}/{{$propertie}}">
									@elseif(isset($data)==true)
									<a href="/user/san-pham/{{$product->id}}/{{$propertie}}">
									@endif	
									<button type="button" class="btn btn-light" style="padding: 10px 10px;">{{$propertie}}</button>
									</a> 				
									@endforeach
									@endif		
								</div>
							</div>

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6" style="justify-content: left;">
									Size:
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="property_id" style="padding: 10px 10px; width: 210px;border-radius: 5px;">
										<option value="0">Chon size</option>
											@foreach($sizes as $size)
											<option value="{{$size->id}}">{{$size->size}}   (sl: {{$size->quantity}})</option>
											@endforeach
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Add to cart
									</button>
									<input type="hidden" name="product_id" value="{{$product->id}}">
									@csrf
								</form>
								</div>
							</div>	
						</div>

						<!--  -->
						
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Mô tả sản phẩm</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Hướng dẫn chọn size</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá sản phẩm ({{$demcomment}})</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									{!!$product->content!!}
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
						<table style="width:70%; border:1px solid black;margin-left: auto;margin-right: auto;">
  							<tr style=" border:1px solid black;">
    							<th style=" border:1px solid black; text-align: center;">SIZE (T-SHIRT)</th>
    							<th style=" border:1px solid black; text-align: center;">M</th>
    							<th style=" border:1px solid black; text-align: center;">L</th>
								<th style=" border:1px solid black;text-align: center;">XL</th>
								<th style=" border:1px solid black;text-align: center;">XXL</th>
  							</tr>
  							<tr style=" border:1px solid black;">
    							<td style=" border:1px solid black;text-align: center;">Cân Nặng (kg)</td>
    							<td style=" border:1px solid black;text-align: center;"> < 60 </td>
    							<td style=" border:1px solid black;text-align: center;">60-70</td>
								<td style=" border:1px solid black;text-align: center;">70-85</td>
								<td style=" border:1px solid black;text-align: center;">>85</td>
  							</tr>
  							<tr style=" border:1px solid black;">
    							<td style=" border:1px solid black;text-align: center;">Dài (cm)</td>
    							<td style=" border:1px solid black;text-align: center;">67</td>
    							<td style=" border:1px solid black;text-align: center;">69</td>
								<td style=" border:1px solid black;text-align: center;">71</td>
								<td style=" border:1px solid black;text-align: center;">73</td>
  							</tr>
							<tr style=" border:1px solid black;">
    							<td style=" border:1px solid black;text-align: center;">Ngang (cm)</td>
    							<td style=" border:1px solid black;text-align: center;">54</td>
    							<td style=" border:1px solid black;text-align: center;">56</td>
								<td style=" border:1px solid black;text-align: center;">58</td>
								<td style=" border:1px solid black;text-align: center;">60</td>
  							</tr>
						</table>
						<table style="width:70%; border:1px solid black;margin-left: auto;margin-right: auto;margin-top: 20px;">
  							<tr style=" border:1px solid black;">
    							<th style=" border:1px solid black;text-align: center;">SIZE (SHIRT, OUTERWEAR)</th>
    							<th style=" border:1px solid black;text-align: center;">M</th>
    							<th style=" border:1px solid black;text-align: center;">L</th>
								<th style=" border:1px solid black;text-align: center;">XL</th>
  							</tr>
  							<tr style=" border:1px solid black;">
    							<td style=" border:1px solid black;text-align: center;">Cân Nặng (kg)</td>
    							<td style=" border:1px solid black;text-align: center;"> < 60 </td>
    							<td style=" border:1px solid black;text-align: center;">60-70</td>
								<td style=" border:1px solid black;text-align: center;">70-85</td>
  							</tr>
						</table>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										@foreach($comments as $comment)
											@foreach($useralls as $userall)
												@if($comment->id_user==$userall->id)
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="/template/images/avatar123.jpg" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20" style="color: green;">
														#{{$userall->name}}
													</span>
													

													<!-- <span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span> -->
												</div>

												<p class="stext-102 cl6">
													{{$comment->comment}}
												</p>
												<p class="stext-102 cl6" style="margin-left: 65%;">
												{{date('d-m-Y H:i:s',strtotime($comment->date))}}
												</p>
											</div>
										</div>
												@endif
											@endforeach
										@endforeach
									
										<!-- Add review -->
										@if(isset($data)==true)
										@if($userdamuahang>0)
										
										<form class="w-full" action="" method="post">
											<h5 class="mtext-108 cl2 p-b-7">
												Viết bình luận về sản phẩm
											</h5>

											<p class="stext-102 cl6">
												Bạn đã mua sản phẩm, bạn có thể viết đánh giá về sản phẩm tại đây *
											</p>

											<!-- <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Danh gia cua ban ve san pham
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div> -->

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<!-- <label class="stext-102 cl3" for="review">Your review</label> -->
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="comment"></textarea>
												</div>
												<input type="hidden" name="id_user" value="{{$data->id}}">
											</div>

											<button type="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
											@csrf
										</form>
										@endif
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: JAK-01
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Categories: Jacket, Men
			</span>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

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
											Xem Thêm
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

												<span class="stext-105 cl3">
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

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="/template/images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/template/images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/template/images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/template/images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="/template/images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

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

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="/template/images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="#">
										<div class="wrap-pic-w pos-relative">
											<img src="#" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="#">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="/template/images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="/template/images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/template/images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="/template/images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="/template/images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/template/images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	@include('footer')

</body>
</html>