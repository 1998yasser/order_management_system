<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Costumer;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_created',
        'tracking',
        'status',
        'confirmed'
    ];

    const UPDATED_AT = 'date_modified';
    
    public function customer(){
        return $this->belongsTo(Costumer::class,"customer_id","phone");
    }

    // many to many  -- les fonction de relation se transforme en attribut dynamique
    public function product(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}
