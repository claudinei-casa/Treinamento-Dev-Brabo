<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Testimony extends Model
{
    protected $fillable = [
        'name','role','description','image_id'
    ];

    protected $with = ['image'];

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
