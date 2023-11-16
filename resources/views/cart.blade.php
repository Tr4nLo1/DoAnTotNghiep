@php $total=0; @endphp

<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>
				@php $total=0; @endphp
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
				@if(isset($propertys))
						@foreach($propertys as $key=>$property)
							@foreach($products as $product)
								@if($property->product_id==$product->id)
								@php
								$price=$product->price;
								$priceEnd = $price*$carts[$property->id];
								$total +=  $priceEnd;
								@endphp	
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img" style="margin: right 10px;">
							<img src="{{$product->thumb}}" alt="IMG" style="margin: right 10px;">
						</div>

						<div class="header-cart-item-txt p-t-8">
							@if(isset($data)==false)
							<a href="/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="header-cart-item-info">
							@elseif(isset($data)==true)
							<a href="/user/san-pham/{{$product->id}}/{{$product->danhmuc_id}}-{{\Str::slug($product->name),'-'}}.html" class="header-cart-item-info">
							@endif	
							{{$product->name}}
							</a>
							<span class="header-cart-item-info">
							 price: {{ number_format($product->price, 0,'','.')}}VND
							</span>
							<span class="header-cart-item-info">
								Color: {{$property->color}} - Size: {{$property->size}}
							</span>
							<span class="header-cart-item-info">
								sl: {{$carts[$property->id]}} - Total: {{number_format($priceEnd, 0,'','.')}} VND
							</span>
							
						</div>
					</li>		@endif
							@endforeach
						@endforeach
					@endif
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: {{number_format($total, 0,'','.')}} VND
					</div>

					<div class="header-cart-buttons flex-w w-full">
					@if(isset($data)==false)
						<a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
					@elseif(isset($data)==true)
					<a href="/user/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
						@endif
							View Cart
						</a>
						<!-- @if(isset($data)==false)
						<a href="/check-out" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
						@elseif(isset($data)==true)
						<a href="/user/check-out" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
						@endif
							Check Out
						</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>