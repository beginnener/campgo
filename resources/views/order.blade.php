<?php
            // dd($orderItems);


?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('layouts.head-css',['title' => 'Your Order - CampGo'])
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		@include('layouts.navbar-desktop')

	</header>

	<!-- Cart -->
	@include('layouts.cart')


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>
				
			<span class="stext-109 cl4">
				Your order
			</span>
			</div>
			</div>
			
			
			<!-- Shoping Cart -->
			<div class="container">
				<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Lending Days</th>
									<th class="column-5">Total</th>
								</tr>

								<?php
									$total = 0;
								?>

								@foreach ($order as $index=>$order)
								<?php 
									$total = $total + $order->product->harga_produk;
								?>
									<tr class="table_row">
										<td class="column-1">
											<div class="how-itemcart1">
												<img src="{{ $order->product->img_produk }}" alt="IMG">
											</div>
										</td>
										<td class="column-2">{{ $order->product->nama_produk }}</td>
										<td class="column-3">Rp{{ number_format($order->product->harga_produk) }}</td>
										<td class="column-4">{{ $orderItems[$index]['lendDays'] }} Day/s</td>
										<td class="column-5">Rp{{ number_format($orderItems[$index]['ItemTotalPrice']) }}</td>
										<td class="columns-6  pr-4">
											<form action="{{ url('del_order', $order->id) }}" method="POST">
												@csrf
												<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">delete</button>
											</form>
										</td>
									</tr>
									
								@endforeach
								
							</table>
						</div>

						
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Order Totals
							</h4>
							
							<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
									</span>
									</div>
									
									<div class="size-209">
								<span class="mtext-110 cl2">
									Rp{{ number_format($total_price) }}
								</span>
								</div>
								</div>
								
						<form class="bg0 p-t-75 p-b-85" action="{{ url('confirm_order') }}" method="post">
						@csrf
								<div class="flex-w flex-t bor12 p-t-15 p-b-30">
									<div class="size-208 w-full-ssm">
										<span class="stext-110 cl2">
											Shipping:
								</span>
							</div>
								<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
									<p class="stext-111 cl6 p-t-2">
										Peminjaman hanya available untuk wilayah jabodetabek. Ongkos kirim Rp10.000  
										</p>
										<p class="stext-111 cl6 p-t-2">
											<i>*Gratis ongkir untuk peminjaman diatas Rp1.000.000</i>
											</p>
											<div class="p-t-15">
												<span class="stext-112 cl8">
										Shipping Address
										</span>
										<div class="bor8 bg0 m-b-12">
											<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" value="{{ Auth::user()->address }}">
									</div>
								</div>
								</div>
							</div>			
					
						
							<div class="flex-w flex-t bor12 p-t-15 p-b-30">
								<div class="size-208 w-full-ssm">
									<span class="stext-110 cl2">
										Total Ongkir:
									</span>
								</div>
								
								<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
									<p class="stext-110 cl2 p-t-2">
										Rp{{ number_format($price_shipping) }}
									</p>
								</div>
							</div>			
							
							<div class="flex-w flex-t bor12 p-t-15 p-b-30">
								<div class="size-208 w-full-ssm">
									<span class="stext-110 cl2">
										Payment Method: 
									</span>
								</div>
							
								<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12">
										<select class="js-select2" name="method">
											<option>Qris</option>
											<option>Transfer Bank</option>
											<option>Shopeepay</option>
											<option>Gopay</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>			

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>
							
							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									Rp{{ number_format($total_price_shipping) }}
								</span>
							</div>
						</div>
						<input class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit" value="Proceed To Checkout">
						</form>
					</div>
				</div>
			</div>
		</div>
		
	
		

	@include('layouts.footer')
</body>
</html>