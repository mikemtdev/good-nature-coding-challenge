<?php

namespace App\Http\Controllers;

use App\Models\farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    //


    public  function index ()
    {
    $farmers = \App\Models\Farmer::paginate(10);
     return view("farmers.index ", compact('farmers'));
    }

    public function create()
    {
        return view("farmers.create");
    }

    public function store(Request $request)
    {
        $request->validate([     'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'location' => 'required|string|max:255',]);


        Farmer::create($request->only('name', 'phone', 'location'));

        return redirect()->route("farmers.index")->with("success",'Farmer added successfully!' );
    }
}
