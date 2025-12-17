<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;

class FarmerController extends Controller
{
    public function map() {
        $farmers = Farmer::where('region', 'Gelderland')->get(); 
        
        return view('map', ['farmers' => $farmers]);


    }

}
