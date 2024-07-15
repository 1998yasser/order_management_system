<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        $users = User::get();
        return view("laravel-examples.user-management" , compact("users"));
    }

    public function add(Request $request){
        User::create([
            'phone' => $request->phone,
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'password'=>Hash::make($request->password),
            'role' => $request->role,
        ]);
        return to_route("users");
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        if($request->password==""){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,

            ]);
            return to_route("users");

        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password'=>Hash::make($request->password),
                'role' => $request->role,

            ]);
            return to_route("users");
        }

    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return to_route("users");
    }
}
