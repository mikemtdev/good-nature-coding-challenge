<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmerController extends Controller
{
    //
    public  function index ()
    {
    $farmers = \App\Models\Farmer::paginate(10);
     return view("farmers.index ", compact('farmers'));
    }
}
