<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTrip extends Model
{
    protected $fillable = [
    	'name', 'description', 'price', 'location', 'length', 'itinerary', 'image',
    ];
}
