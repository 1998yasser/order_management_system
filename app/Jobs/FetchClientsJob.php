<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class FetchClientsJob implements ShouldQueue
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
}
