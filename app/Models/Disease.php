<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;


    protected $fillable = [
        'disease_name',
        'disease_description',
        'remedies',
        'weather',
        'image'
    ];
}
