<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'point_depart',
        'point_arrivee',
        'category_id',
        'date',
        'duree',
        'user_id',
    ];
}
