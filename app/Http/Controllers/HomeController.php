<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\invoice;
use App\Models\Transaction;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    // untuk mengembalikan view to admin dashboard
    public function index(){
        
        $transactions = Transaction::orderby('created_at', 'desc')->paginate(10);
        return view('admin.index', compact('transactions'));
    }

    // fungsi supaya admin tidak bisa mengakses view user
    public function usertype_dashboard(){
        if(auth()->user()->usertype != 'admin'){
            $user = Auth::user();
            $id_user = $user->id;
            $booking = Order::where('id_user', $id_user)
                    ->whereIn('booking_status', ['booked', 'returning', 'completed'])
                    ->get();
            return view('dashboard', compact('booking'));
        }
        return redirect('admin/dashboard');
    }

    // fungsi untuk memastikan user tidak bisa menakses dashboard admin dan sebaliknya
    public function usertype_index(){
        $user = auth()->user();

        if($user && $user->usertype == 'admin'){
            return redirect('admin/dashboard');
        }
        
        $bestSellers = Product::select('products.*', DB::raw('COUNT(orders.id_produk) as total_orders'))
                    ->join('orders', 'products.id', '=', 'orders.id_produk')
                    ->groupBy('products.id', 'products.nama_produk', 'products.harga_produk', 'products.img_produk', 'products.deskripsi_produk','products.stok_produk','products.id_merk','products.id_kategori','products.id_activity','products.created_at','products.updated_at')
                    ->orderBy('total_orders', 'desc')
                    ->limit(10)
                    ->get();

        return view('index', compact('bestSellers'));
    }

    // fungsi untuk add to order
    public function add_order($id, Request $request){
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $start_date = $request->tanggal_peminjaman;
        $end_date = $request->tanggal_pengembalian;
        $data = new Order;
        $data->id_user = $user_id; 
        $data->id_produk = $product_id;
        $data->start_date = $start_date;
        $data->end_date = $end_date;
        $data->save(); //save data kedalam database
        
    
        return redirect()->back();
    }

    // fungsi untuk melihat order
    public function view_order(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;

            $order = Order::where('id_user', $userId)
                    ->where('booking_status', 'needs_payment')
                    ->get();

            $orderItems = []; // Array untuk menyimpan data order items           
            $total_price = 0;
            foreach($order as $item){
                $startDate = Carbon::parse($item->start_date); 
                $endDate = Carbon::parse($item->end_date); 
                $difftime = $startDate->diffInDays($endDate); //menghitung selisih hari
                $item_total_price = $item->product->harga_produk * $difftime; //menghitung total harga
                $total_price += $item_total_price; //menjumlahkan total harga

                //masukan difftime dan total harga setelah dikasi difftime kedalam array assosiatif
                $orderItems[] = [ 
                    'lendDays' => $difftime,
                    'ItemTotalPrice' => $item_total_price
                ];
            }
            
            $price_shipping = 0;
            
            if($total_price < 1000000){
                $price_shipping = 10000;
            }        
            
            $total_price_shipping = $total_price + $price_shipping; 
            return view('order', compact('order', 'total_price', 'total_price_shipping','price_shipping', 'orderItems'));
        }
        
        return view('login');
    }
    
    // fungsi apabila tombol proceed to checkout dipencet
    public function confirm_order(Request $request){
        $user = Auth::user();
        $userId = $user->id;
        $address = $request->address;
        $method = $request->method;
        
        $order = Order::where('id_user', $userId)
        ->where('booking_status', 'needs_payment')
        ->get();
        
        $orderItems = []; // Array untuk menyimpan data order items           
        $total_price = 0;
            foreach($order as $item){
                $startDate = Carbon::parse($item->start_date); 
                $endDate = Carbon::parse($item->end_date); 
                $difftime = $startDate->diffInDays($endDate); //menghitung selisih hari
                $item_total_price = $item->product->harga_produk * $difftime; //menghitung total harga
                $total_price += $item_total_price; //menjumlahkan total harga

                //masukan difftime dan total harga setelah dikasi difftime kedalam array assosiatif
                $orderItems[] = [ 
                    'lendDays' => $difftime,
                    'ItemTotalPrice' => $item_total_price
                ];
            }
        
        
        $price_shipping = 0;
        
        if($total_price < 1000000){
            $price_shipping = 10000;
        }        
        $total_price_shipping = $total_price + $price_shipping; 
        
        // input ke database
        $transaction = new Transaction;
        $transaction->id_user = $userId;
        $transaction->alamat_pengiriman = $address;
        $transaction->total_transaksi = $total_price_shipping;
        $transaction->metode_transaksi = $method;
        $transaction->status_transaksi = 'in progress';
        $transaction->save();
        
        // ambil id transaksi
        $id_trans = Transaction::latest()->first();
        
        // ubah status barang di cart
        foreach ($order as $order) {
            // deklarasi tabel invoice
            $invoice = new invoice;
            $invoice->id_transaction = $id_trans->id;
            $invoice->id_booking = $order->id;
            $invoice->status = 'needs payment';
            $invoice->save();
            $order->booking_status = 'processing';
            $order->save();
        }
        
        $invoice_id = invoice::latest()->first();
        $id_trans = $invoice_id->id_transaction;
        
        $order = Order::where('id_user', $userId)
                    ->where('booking_status', 'processing')
                    ->get();
        
        return redirect()->route('invoice', $id_trans);
    }

    // fungsi untuk menampilkan invoice
    public function invoice($id){
        $user = Auth::user();
        $userId = $user->id;
        
        // Mengambil informasi transaksi
        $transaction = Transaction::where('id', $id)->where('id_user', $userId)->first();
        if (!$transaction) {
            return back()->withErrors(['msg' => 'Transaksi tidak ditemukan']);
        }
    
        // Mengambil daftar invoice yang terkait dengan transaksi
        $invoices = Invoice::where('id_transaction', $id)->get();
    
        // Mengambil detail pesanan untuk setiap invoice
        $orderlists = [];
        foreach($invoices as $invoice) {
            $order = Order::where('id', $invoice->id_booking)->with('product')->first();
            if ($order) {
                $orderlists[] = $order;
            }
        }

        
        $orderItems = []; // Array untuk menyimpan data order items           
        $total_price = 0;
        foreach($orderlists as $item){
            $startDate = Carbon::parse($item->start_date); 
            $endDate = Carbon::parse($item->end_date); 
            $difftime = $startDate->diffInDays($endDate); //menghitung selisih hari
            $item_total_price = $item->product->harga_produk * $difftime; //menghitung total harga
            $total_price += $item_total_price; //menjumlahkan total harga
            
            //masukan difftime dan total harga setelah dikasi difftime kedalam array assosiatif
            $orderItems[] = [ 
                'lendDays' => $difftime,
                'ItemTotalPrice' => $item_total_price
            ];
        }
        
        $price_shipping = 0;
        
        if($total_price < 1000000){
            $price_shipping = 10000;
        }        
        $total_price_shipping = $total_price + $price_shipping; 
        // Mengirim data ke view
        return view('invoice', compact('transaction', 'invoices', 'orderlists', 'orderItems','price_shipping'));
    }
    
    //fungsi untuk delete order
    public function del_order($id){
        if(Auth::check()){
            $user = Auth::user();
            $userId = $user->id;
            $order = Order::where('id_user', $userId)
                    ->where('id', $id)
                    ->where('booking_status', 'needs_payment')
                    ->delete();
        
        return redirect()->back()->with('success', 'Item berhasil dihapus');
        }
    }

    public function checkout($id){
        $invoice = invoice::where('id_transaction', $id)
                ->get();
        
        foreach($invoice as $invoice){
            $invoice->status = 'paid';
            $invoice->save();
        }

        return redirect()->route('dashboard');
    }

    public function return($id){
        $user=Auth::user();
        $userId = $user->id;

        $return = Order::where('id_user', $userId)
                ->where('id', $id)
                ->where('booking_status', 'booked')
                ->first();

        $return->booking_status = 'returning';
        $return->save();

        return redirect()->back();
    }

    public function acc_return($id){
        $users = DB::table('invoices')
                ->join('orders', 'invoices.id_booking', '=', 'orders.id')
                ->where('invoices.id_transaction', $id)
                ->select('orders.*')
                ->get();

                foreach ($users as $user) {
                    $user_id = $user->id_user;
                    // Lakukan sesuatu dengan $user_id
                    // Misalnya, cetak user_id
                    echo $user_id;
                }

        // $return = Order::where('id_user', $userId)
        //         ->where('id', $id)
        //         ->where('booking_status', 'booked')
        //         ->first();

        // $return->booking_status = 'returning';
        // $return->save();

        return redirect()->back();
    }


}
