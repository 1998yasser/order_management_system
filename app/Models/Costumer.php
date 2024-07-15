<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Costumer extends Model
{
    use HasFactory;

    protected $primaryKey = 'phone' ;

    protected $fillable = ['phone','first_name','last_name','email','address_1','remarques','postcode','city'];

    protected $casts = [
        'phone' => 'string',
    ];
    
    public function order(){
        return $this->hasMany(Order::class,"customer_id","phone");
    }
}
