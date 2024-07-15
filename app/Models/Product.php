<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["name","slug", "price","total_sales","stock_quantity","stock_status"];

    public function order(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
