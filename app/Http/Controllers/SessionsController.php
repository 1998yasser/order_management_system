<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('dashboard')->with(['success'=>'You are logged in.']);
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }

    public function getClient(){
        $response = Http::withBasicAuth('ck_d8597a8e03dcb2b349330a490994f4d6a885acf0', 'cs_6ededdc559e1af07ef44cbf4c2568bbd3b286157')
        ->get('https://mysi.ma/wp-json/wc/v3/orders');

            if ($response->successful()) {
            $orders = $response->json(); // Get the JSON response body
            foreach($orders as $order){


                    $ClientData = [
                        'phone' => $order['billing']["phone"], // Primary key value
                        'first_name' => $order['billing']["first_name"],
                        'last_name' => $order['billing']["last_name"], // or '', depending on your preference
                        'address_1' => $order['billing']["address_1"],
                        'city' => $order['billing']["city"], // or '', depending on your preference
                        'postcode' => $order['billing']["postcode"], // or '', depending on your preference
                        'email' => $order['billing']["email"], // or '', depending on your preference
                    ];





                // Check if the product already exists in the database based on its name
                $ClientExist = DB::table('costumers')->where('phone', $ClientData['phone'])->first();

                // If the product doesn't exist, insert it into the database
                if (!$ClientExist) {
                    DB::table('costumers')->insert($ClientData);

                }

            }
            }
    }

    public function getProduct()
    {
        $response = Http::withBasicAuth('ck_d8597a8e03dcb2b349330a490994f4d6a885acf0', 'cs_6ededdc559e1af07ef44cbf4c2568bbd3b286157')
        ->get('https://mysi.ma/wp-json/wc/v3/products');

            if ($response->successful()) {
            $products = $response->json(); // Get the JSON response body
            foreach($products as $product){
                $productData = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'slug' => $product['slug'],

                    'price' => $product['price'],
                    'total_sales' => $product['total_sales'],
                    'stock_quantity' => $product['stock_quantity'],
                    'images' => $product['images'][0]['src'],
                    'stock_status' => $product['stock_status'],


                ];



                // Check if the product already exists in the database based on its name
                $productExist = DB::table('products')->where('id', $productData['id'])->first();

                // If the product doesn't exist, insert it into the database
                if (!$productExist) {
                    DB::table('products')->insert($productData);

                }


            }


            }
    }

    public function getOrder(){
        $response = Http::withBasicAuth('ck_d8597a8e03dcb2b349330a490994f4d6a885acf0', 'cs_6ededdc559e1af07ef44cbf4c2568bbd3b286157')
        ->get('https://mysi.ma/wp-json/wc/v3/orders');

        if ($response->successful()) {

        $orders = $response->json(); // Get the JSON response body
        // return view("orders",compact('orders'));

        foreach($orders as $order){
        
            $dateCreated = $order['date_created'];
            $dateModified = $order['date_modified'];
            $formattedDate_1 = Carbon::createFromFormat('Y-m-d\TH:i:s', $dateCreated)->toDateString();
            $formattedDate_2 = Carbon::createFromFormat('Y-m-d\TH:i:s', $dateModified)->toDateString();

            $Data = [
                'id' => $order['id'],
                'status' => $order['status'],
                'date_created' => $formattedDate_1 ,
                'date_modified' => $formattedDate_2,
                'discount_total' => $order['discount_total'],
                'shipping_total' => $order['shipping_total'],
                'total' => $order['total'],
                'customer_id' =>$order['billing']["phone"],
            
            ];
        
            // Check if the product already exists in the database based on its name
            $result = DB::table('orders')->where('id', $Data['id'])->first();
        
            // If the ordrer doesn't exist, insert it into the database
            if (!$result) {
            
                DB::table('orders')->insert($Data);
            
                //insertion dans la table order_product
                $lines=$order['line_items'];
            
                foreach($lines as $product){
                
                    $Data_product = [
                        'order_id' => $order['id'],
                        'product_id' => $product['product_id'],
                        'quantity' => $product['quantity'] ,
                    ];
                
                    $productExist = DB::table('products')->where('id', $Data_product['product_id'])->first();
                    if(!$productExist){
                    
                        $price=str($product['price']);
                    
                        DB::table('products')->insert([
                            'id'=>$product['product_id'],
                        
                            'name' => $product['name'],
                        
                            'price' =>  $price,
                        
                            'images' => $product['image']['src'],
                        
                        ]);
                    
                    }
                    DB::table('order_product')->insert($Data_product);
                
                
                }
            
            
            
            }
        }
        }
    }
}
