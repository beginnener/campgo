
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	@include ('layouts.head-css', ['title'=>'CampGo - make your camping experience better'])

<body class="animsition">
	
	<!-- Header -->
	<header>

		@include ('layouts.navbar-desktop')
		
	</header>

	<!-- Cart -->
	@include ('layouts.cart')

	<!-- Slider -->
	@include ('layouts.slider')

	<!-- Banner -->
	{{-- @include ('layouts.banner') --}}


	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container" style="padding-top: 120px">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					BEST SELLING PRODUCTS
				</h3>
			</div>
		{{-- @include ('layouts.product-nav') --}}

			<div class="row isotope-grid">
				{{-- ini ditambhain danes --}}
				
				@foreach ($bestSellers as $bestSellers)
				{{-- nanti tampilinnya pake foreach php, yang <?$bestSellers['category']?> blablabla itu dipanggil pake syntax php, 
					sekali lagi sesuaikan sama database yang nanti kita bikin, trus disesuaikan sama syntaxnya lah pokonya--}}
			<a href="/product-detail/{{ $bestSellers['id'] }}" >
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
					<!-- Block2 -->
					<div class="block2">
						<div  class="block2-pic hov-img0">
							<img src="{{ $bestSellers['img_produk'] }}" alt="IMG-PRODUCT">
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="/product-detail/{{ $bestSellers['id'] }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{ $bestSellers['nama_produk'] }}
								</a>

								<span class="stext-105 cl3">
									Rp{{ number_format($bestSellers['harga_produk']) }}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
			</a>
				@endforeach
			</div>
				
				
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="/shop" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		</div>
	</section>


	<!-- Footer -->
	@include ('layouts.footer')
	
</body>
</html>