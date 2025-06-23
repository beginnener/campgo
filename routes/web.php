<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\product;

// Route::get('/', function () {
//     return view('index', ['products' => Product::all()]);
// })->name('index');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/shop', function (product $product) {
    return view('product', ['products' => Product::all()]);
})->name('shop');

Route::get('/shop/hiking', function (product $product) {
    $hiking = Product::where('id_activity','1')
            ->get();

    if($hiking){
        return view('product', ['products' => $hiking]);
    }
})->name('shop');

Route::get('/shop/camping', function (product $product) {
    $camping = Product::where('id_activity','2')
            ->get();
    if($camping){
        return view('product', ['products' => $camping]);
    }
})->name('shop');

Route::get('/product-detail/{product}', function (product $product) {
    return view('product-detail', ['product' => $product]);
})->name('details');

route::get('invoice/{id}', [HomeController::class, 'invoice'])->name('invoice');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php'; //ini apa?

route::get('/dashboard',[HomeController::class, 'usertype_dashboard'])->name('dashboard');
route::get('admin/dashboard',[HomeController::class, 'index'])->middleware(['auth', 'admin']);
route::get('add_order/{id}',[HomeController::class, 'add_order'])->middleware(['auth', 'verified']);
route::get('view_order',[HomeController::class, 'view_order'])->middleware(['auth', 'verified']);
route::post('confirm_order',[HomeController::class, 'confirm_order'])->middleware(['auth', 'verified']);
route::post('del_order/{id}',[HomeController::class, 'del_order'])->middleware(['auth', 'verified'])->name('delete');
route::get('invoice/{id}',[HomeController::class, 'invoice'])->middleware(['auth', 'verified'])->name('invoice');
route::get('checkout/{id}',[HomeController::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');
route::get('return/{id}',[HomeController::class, 'return'])->middleware(['auth', 'verified']);
route::get('acc_return/{id}',[HomeController::class, 'acc_return'])->middleware(['auth', 'verified']);

// admin routing
route::get('acc_transaction/{id}',[AdminController::class, 'acc_transaction'])->middleware(['auth', 'verified']);
route::get('/',[HomeController::class, 'usertype_index'])->name('index');