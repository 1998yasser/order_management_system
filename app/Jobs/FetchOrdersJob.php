<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FetchOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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
