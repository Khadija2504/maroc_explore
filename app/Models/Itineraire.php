<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function destination()
    {
        return $this->hasMany(Destinations::class, 'id_itineraire');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function point_depart(){
        return $this->belongsTo(City::class, 'point_depart');
    }
    public function point_arrivee(){
        return $this->belongsTo(City::class, 'point_arrivee');
    }
}
