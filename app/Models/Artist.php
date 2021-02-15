<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Album;

class Artist extends Model
{
    use HasFactory;

    public function albums()
    {
        // albums.artist_id is the foregin key column
        return $this->hasMany(Album::class);
    }
}
