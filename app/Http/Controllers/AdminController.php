<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function acc_transaction($id){
        $transaction = Transaction::find($id);
        $transaction->status_transaksi = 'completed';
        $transaction->save();
        
        $id_user = $transaction->id_user;
        $id_trans = $transaction->id;
        
        $orders = DB::table('orders')
                ->join('invoices', 'invoices.id_booking','=','orders.id')
                ->where('invoices.id_transaction', '=', $id_trans)
                ->get();
        
        foreach($orders as $order) {
            // Ambil pesanan yang terkait dengan invoice
            $order = Order::find($order->id_booking);
            if ($order && $order->booking_status === 'processing') {
                // Update status booking pada pesanan
                $order->booking_status = 'booked';
                $order->save();
            }
        }
        
        return redirect('admin/dashboard');
    }
}
