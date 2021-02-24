<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Testimony;
use App\Portfolio;

class Image extends Model
{
    protected $fillable = ['path','description'];

    public function testimonies() {
        return $this->hasMany(Testimony::class);
    }

    public function portfolios() {
        return $this->hasMany(Portfolio::class);
    }
}

