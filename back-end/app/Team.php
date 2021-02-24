<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Team extends Model
{
    protected $fillable = [
        'image_id','name', 'role', 'twitter', 'facebook', 'instagram', 'linkedin'
    ];

    //concatena os modulos
    protected $with = ['image'];

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
