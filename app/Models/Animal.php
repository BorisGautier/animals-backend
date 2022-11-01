<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title', 'description', 'classe', 'order', 'family', 'date_naissance', 'sexe', 'localisation', 'longitude', 'latitude', 'funfact', 'diet', 'habitat', 'menaces', 'couleur', 'cover_url'
    ];

    public function medias()
    {
        return $this->hasMany(Medias::class, "animal_id");
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class, "animal_id");
    }
}
