<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Costumer;
use App\Jobs\FetchOrdersJob;
use Illuminate\Http\Request;
use App\Jobs\FetchClientsJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SessionsController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SessionsController $sessionsController)
    {

        $sessionsController->getClient();
        $sessionsController->getProduct();
        $sessionsController->getOrder();


        $count = Order::count();
        $totalOrders = Order::sum('total');
        $orders = Order::with('customer')->orderBy('date_created', 'desc')->where('status','processing')->paginate(10);

        $response = Http::get('https://api.ozonexpress.ma/cities');
        $cities = $response->json();
        $cities = $cities['CITIES'];

        $confirmedOrders = Order::with('customer')->orderBy('date_created', 'desc')->where('confirmed',1)->paginate(10);
        $lastOrderDate = Order::latest('date_created')->where('confirmed',1)->value('date_created');

        return view('orders',compact('orders','count','totalOrders','cities','confirmedOrders','lastOrderDate'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function cancel($id)
    {
        $order = Order::with('customer')->where("id",$id)->first();
        $order->update([

            'confirmed' => 0,
            'status' => 'canceled'
        ]);
        return redirect()->route('orders');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function confirm(Request $request, $id){
        $orders = Order::with('customer')->where("id",$id)->first();
        $cityId = $request->city;
        $name = $orders['customer']['first_name']." ".$orders['customer']['last_name'];

        $options = [
            'multipart' => [
                [
                    'name' => 'parcel-receiver',
                    'contents' => $name
                ],
                [
                    'name' => 'parcel-phone',
                    'contents' => $orders['customer_id']
                ],
                [
                    'name' => 'parcel-city',
                    'contents' => $cityId
                ],
                [
                    'name' => 'parcel-address',
                    'contents' => $orders['customer']['address_1']
                ],
                [
                    'name' => 'parcel-note',
                    'contents' => $request->notes
                ],
                [
                    'name' => 'parcel-price',
                    'contents' => $orders['total']
                ]
            ]
        ];

        try {
            $response = Http::send('POST', '', $options);
            $data = json_decode($response, true);

            $trackingNumber = $data['ADD-PARCEL']['NEW-PARCEL']['TRACKING-NUMBER'];
            $deliveredPrice = $data['ADD-PARCEL']['NEW-PARCEL']['DELIVERED-PRICE'];

           if($trackingNumber){
            $result = Order::find($id);
            $costumer = Costumer::find($result->customer_id);
            if($result){
                $updated =  $result->update([
                    "tracking"=>$trackingNumber,
                    "confirmed"=>1,
                    "status"=>"confirmed",
                ]);
            }
            if($costumer){
                $costumer->update([
                    "city"=>$cityId,
                ]);
            }
           }
            return redirect()->route('orders');

        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

}

}
