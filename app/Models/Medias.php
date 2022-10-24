<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medias extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'animal_id',
        'type_media_id', 'media_url'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function typeMedia()
    {
        return $this->belongsTo(TypeMedias::class);
    }
}
