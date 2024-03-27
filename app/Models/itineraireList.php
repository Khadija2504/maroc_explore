<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itineraireList extends Model
{
    use HasFactory;
    protected $fillable = [
        'itineraire_id',
        'user_id',
    ];
    public function itineraires(){
        return $this->belongsTo(itineraire::class, 'itineraire_id');
    }
}
