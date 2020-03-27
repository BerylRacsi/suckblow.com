<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\PartnerTrip;
use App\UserTrip;
use App\Agency;
use App\Facility;
use Alert;

class TripController extends Controller
{
    public function index()
    {
    	$partnertrip = PartnerTrip::all();
    	foreach ($partnertrip as $trip) {
    		$trip['link'] =  'partnertrip';
    	}

    	$usertrip = UserTrip::all();
    	foreach ($usertrip as $trip) {
    		$trip['link'] =  'usertrip';
    	}

    	$merged = collect();
    	$merged = $merged->merge($partnertrip)->merge($usertrip);

    	$trips = $merged->shuffle();

    	return view('main/trip/index',compact('trips'));
    }

    public function search(Request $request)
    {
        $keyword =  $request->search;

        $partnertrip = PartnerTrip::where('name' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('description' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('location' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('address' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('agency' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('facility' , 'LIKE' , '%' . $keyword . '%')
                        ->get();
    	foreach ($partnertrip as $trip) {
    		$trip['link'] =  'partnertrip';
    	}

    	$usertrip = UserTrip::where('name' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('description' , 'LIKE' , '%' . $keyword . '%')
                        ->orWhere('location' , 'LIKE' , '%' . $keyword . '%')
                        ->get();
    	foreach ($usertrip as $trip) {
    		$trip['link'] =  'usertrip';
    	}

    	$merged = collect();
    	$merged = $merged->merge($partnertrip)->merge($usertrip);

    	$trips = $merged->shuffle();

        return view('main/trip/index',compact('trips'));
    }
}
