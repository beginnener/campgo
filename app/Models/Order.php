<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id_user', 'id_produk', 'start_date', 'end_date'];

    public function product(){
        
        return $this->hasOne('App\Models\Product', 'id', 'id_produk');
    
    }

    use HasFactory;
}
