<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gear extends Model
{
    protected $fillable = [
    	'name', 'description', 'price', 'condition', 'warranty', 'link', 'category', 'image',
    ];
}