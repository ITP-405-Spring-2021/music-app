<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist_id'];

    public function artist()
    {
        // albums.artist_id is the foregin key column
        return $this->belongsTo(Artist::class);
    }
}
