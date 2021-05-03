<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Jobs\AnnounceNewAlbum;
use App\Mail\NewAlbum;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Genre;
use App\Models\Album;
use Illuminate\Support\Facades\Mail;

Route::get('/mail', function () {
    // Mail::raw('What is your favorite framework?', function ($message) {
    //     $message->to('dtang@usc.edu')->subject('Hello David');
    // });

    // dispatch(function () {
    //     $masterOfPuppets = Album::find(152);
    //     Mail::to('dtang@usc.edu')->send(new NewAlbum($masterOfPuppets));
    // });

    // $jaggedLittlePill = Album::find(6);
    // Mail::to('dtang@usc.edu')->queue(new NewAlbum($jaggedLittlePill));

    $jaggedLittlePill = Album::find(6);
    AnnounceNewAlbum::dispatch($jaggedLittlePill);
    // dispatch(new AnnounceNewAlbum($jaggedLittlePill)); // same as above

    // return view('email.new-album', [
    //     'album' => Album::first(),
    // ]);
});

Route::get('/eloquent', function() {
    // QUERYING
    // return view('eloquent.tracks', [
    //     'tracks' => Track::all(),
    // ]);

    // return view('eloquent.artists', [
    //     'artists' => Artist::orderBy('name', 'desc')->get(),
    // ]);

    // return view('eloquent.tracks', [
    //     'tracks' => Track::where('unit_price', '>', 0.99)->orderBy('name')->get(),
    // ]);

    // return view('eloquent.artist', [
    //     'artist' => Artist::find(3),
    // ]);

    // CREATING
    // $genre = new Genre();
    // $genre->name = '(David) Hip Hop';
    // $genre->save();

    // DELETING
    // $genre = Genre::find(34);
    // $genre->delete();

    // UPDATING
    // $genre = Genre::where('name', '=', 'Alternative and Punk')->first();
    // $genre->name = 'Alternative & Punk';
    // $genre->save();

    // RELATIONSHIPS
    // return view('eloquent.has-many', [
    //     'artist' => Artist::find(50), // Metallica
    // ]);

    // return view('eloquent.belongs-to', [
    //     'album' => Album::find(152), // Master of Puppets
    // ]);

    // EAGER LOADING
    return view('eloquent.eager-loading', [
        // Has the N+1 problem
        // 'tracks' => Track::where('unit_price', '>', 0.99)
        //     ->orderBy('name')
        //     ->limit(5)
        //     ->get(),

        // Fixes the N+1 problem via Eager Loading
        'tracks' => Track::with(['album'])
            ->where('unit_price', '>', 0.99)
            ->orderBy('name')
            ->limit(5)
            ->get(),
    ]);
});

Route::get('/', function () {
    return redirect()->route('invoice.index');
});

Route::get('/albums', [AlbumController::class, 'index'])->name('album.index');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create');
Route::post('/albums', [AlbumController::class, 'store'])->name('album.store');
Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('album.edit');
Route::post('/albums/{id}', [AlbumController::class, 'update'])->name('album.update');
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['custom-auth'])->group(function () {
    Route::middleware(['not-blocked'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::view('/blocked', 'blocked')->name('blocked');
});

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}
