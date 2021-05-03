<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::join('artists', 'artists.id', '=', 'albums.artist_id')
            ->with(['artist'])
            ->orderBy('artists.name')
            ->orderBy('title')
            ->select('*', 'albums.id as id')
            ->get();

        return view('album.index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = DB::table('artists')->orderBy('name')->get();

        return view('album.create', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id',
        ]);

        DB::table('albums')->insert([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist'),
        ]);

        return redirect()
            ->route('album.index')
            ->with('success', "Successfully created {$request->input('title')}");
    }

    public function edit($id)
    {
        $artists = DB::table('artists')->orderBy('name')->get();
        $album = DB::table('albums')->where('id', '=', $id)->first();

        return view('album.edit', [
            'artists' => $artists,
            'album' => $album,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id',
        ]);

        DB::table('albums')->where('id', '=', $id)->update([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist'),
        ]);

        return redirect()
            ->route('album.edit', [ 'id' => $id ])
            ->with('success', "Successfully updated {$request->input('title')}");
    }
}
