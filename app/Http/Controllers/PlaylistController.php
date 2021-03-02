<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        return view('playlist.index', [
            'playlists' => Playlist::all(),
        ]);
    }

    public function show($id)
    {
        return view('playlist.show', [
            'playlist' => Playlist::with(['tracks.album', 'tracks.album.artist'])->find($id),
        ]);
    }
}
