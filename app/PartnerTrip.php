<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerTrip extends Model
{
    protected $fillable = [
    	'name', 'description', 'price', 'location', 'address', 'since', 'agency', 'facility', 'logo', 'image',
    ];
}
