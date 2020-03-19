<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
    	'name', 'agency', 'diver', 'open', 'advance', 'rescue', 'master', 'instructor', 'center', 'total', 'since', 'ig', 'fb', 'image',
    ];
}
