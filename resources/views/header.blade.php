<header>
	@php $danhmucsHtml= \App\Helpers\Helper::danhmucs($danhmucs);
		$danhmucsHtmls= \App\Helpers\Helper::userdanhmucs($danhmucs) @endphp
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						<img src="/template/images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
						@if(isset($data)==false)
							<li class="active-menu"><a href="/">Trang chủ</a></li>
                            
                            {!!$danhmucsHtml!!}
                            
							<li>
								<a href="/blog">Blog</a>
							</li>
							@elseif(isset($data)==true)
							<li class="active-menu"><a href="/home">Trang chủ</a></li>
							{!!$danhmucsHtmls!!}
							<li>
								<a href="/user/blog">Blog</a>
							</li>
							@endif	
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" 
						data-notify="{{!is_null(Session::get('carts'))?count(Session::get('carts')):0}}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>	
						<!-- @php var_dump(isset($data)); @endphp -->
						@if(isset($data)==false)
						<a href="/loginuser" class="nav-link">
                        <p>Login</p>
                        </a>
						@elseif(isset($data)==true)
						<ul class="main-menu">
                        <li class="active-menu">
								<p>xin chào <a href="#">{{$data->name}}</a></p>
								<ul class="sub-menu">
								    <li><a href="/user/order"><iconify-icon icon="ant-design:shopping-outlined"></iconify-icon> Order</a></li>
									<li><a href="/user/setting"><iconify-icon icon="zmdi:settings"></iconify-icon> Setting</a></li>
									<li><a href="/"><iconify-icon icon="ci:log-out"></iconify-icon> Logout</a></li>
								</ul>
						</li>
                        </ul>
						@endif	
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.html"><img src="/template/images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
				<a href="#" class="nav-link">
                        <p>Login</p>
                </a>
				
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			

			<ul class="main-menu-m">
			<li class="active-menu"><a href="/">Trang chủ</a></li>
				{!! $danhmucsHtml !!}

				<li>
					<a href="blog.html">Blog</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="/template/images/icons/icon-close2.png" alt="CLOSE">
				</button>
				@if(isset($data)==true)
				<form class="wrap-search-header flex-w p-l-15" action="/user/search" method="get">
				@elseif(isset($data)==false)
				<form class="wrap-search-header flex-w p-l-15" action="/search" method="get">
				@endif
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
					@csrf
				</form>
			</div>
		</div>
	</header>