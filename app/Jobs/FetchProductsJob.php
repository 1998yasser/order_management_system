<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
class FetchProductsJob implements ShouldQueue
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
        $response = Http::withBasicAuth('', '')
        ->get('');

            if ($response->successful()) {
            $products = $response->json(); // Get the JSON response body
            foreach($products as $product){
                $productData = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'slug' => $product['slug'],

                    'price' => $product['price'],
                    'regular_price' => $product['regular_price'],
                    'sale_price' =>$product['sale_price'],
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
}
