<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requestModel extends Model
{
    use HasFactory;
    protected $table = "request_weather";
    public $timestamps = false;

    protected $fillable = [
        'lat',
        'lon'
    ];
}

