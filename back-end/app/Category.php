<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class Category extends Model
{
    protected $fillable = ['name'];

    public function porfolios() {
        return $this->belongsToMany(Portfolio::class);
    }
}