<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\FetchClientsJob;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dispatch(new FetchClientsJob());

        $clients=Costumer::paginate(20);
        return view('clients',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request){
        $client = Costumer::where('phone', $request->phone)->first();
        if (!$client) {
        Costumer::create([
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'remarques' => $request->remarques,
        ]);}
        return to_route("clients");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Costumer $costumer)
    {
        //
    }



    public function update(Request $request, $phone){
        $client = Costumer::where('phone', $phone)->first();
        $client->update([
            'phone' =>$phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address_1' => $request->address_1,
            'remarques' => $request->remarques,
        ]);
        return to_route("clients");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Costumer $costumer)
    {
        //
    }


    // testing relationship 1-N
    public function test(){

        $result=Costumer::where('phone',"0600202510")->first();
        return $result->order;

    }
}
