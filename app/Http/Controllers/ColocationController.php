<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class ColocationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string']
        ]);


        $colo = Colocation::create([
            'name' => $request->name,
            'description' =>$request->description,
            'status'=>'active',
            'token'=> Str::random(20),
            'user_id'=> Auth::user()->id
        ]);


        return redirect(route('owner.dashboard'));
    }
}
