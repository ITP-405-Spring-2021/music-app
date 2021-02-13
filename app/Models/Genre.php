<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Track;

class Genre extends Model
{
    use HasFactory;

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
