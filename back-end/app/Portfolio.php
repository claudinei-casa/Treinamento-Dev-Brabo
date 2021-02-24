<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Image;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'link', 'image_id'
    ];

    protected $with = ['categories','image'];
    
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

}