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

<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30">
            INVOICE
            </h4>
            
        <div class="flex-w flex-t bor12 p-b-13">
            @foreach ($orderlists as $index => $order)
            <div class="size-209">
                <span class="stext-110 cl2">
                {{ $order->product->nama_produk }}
                </span>
            </div>

            <div class="size-208">
                <span class="mtext-110 cl2">
                    Rp{{ number_format($orderItems[$loop->index]['ItemTotalPrice']) }}
                </span>
            </div>
             @endforeach
        </div>
                
        <form class="bg0 p-t-75 p-b-85" action="{{ url('confirm_order') }}" method="post">
        @csrf
                <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                    <div class="size-208 w-full-ssm">
                        <span class="stext-110 cl2">
                            Shipping:
                </span>
            </div>

                {{-- <form action="/{{ url('confirm_order') }}" method="Post"> --}}
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
                            <p class="stext-111 cl8 plh3 size-111 p-lr-15" >{{ $transaction->alamat_pengiriman }}</p>
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
                        <p>{{ $transaction->metode_transaksi }}</p>
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
                    Rp{{ number_format($transaction->total_transaksi) }}
                </span>
            </div>
        </div>
        <a href="{{ route('checkout',$transaction->id) }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Checkout<a>
        </form>
    </div>
</div>

@include('layouts.footer')
</body>
</html>