<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Track;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
Route::post('/albums/{id}', [AlbumController::class, 'update'])->name('albums.update');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/eloquent', function() {
    // QUERYING
    // return Artist::all();
    // return Track::all();
    // return Artist::orderBy('name', 'desc')->get();
    // return Track::where('unit_price', '>', 0.99)->orderBy('name')->get();
    // return Artist::find(3);

    // CREATING
    // $genre = new Genre();
    // $genre->name = 'Hip Hop';
    // $genre->save();
    // return Genre::all();

    // DELETING
    // Genre::where('name', '=', 'Hip Hop')->delete();
    // return Genre::all();

    // UPDATING
    // $genre = Genre::where('name', '=', 'Alternative & Punk')->first();
    // $genre->name = 'Alternative and Punk';
    // $genre->save();
    // return Genre::all();

    // RELATIONSHIPS (ONE TO MANY)
    // return Artist::find(50); // 50 = Metallica
    // return Artist::find(50)->albums;
    // return Album::find(152)->artist; // 152 = Master of Puppets

    // return Track::find(1837); // 1837 = Seek and Destroy
    // return Track::find(1837)->genre;
    // return Genre::find(3)->tracks; // 3 = Metal

    // EAGER LOADING
    // return view('eloquent', [
    //     // 'tracks' => Track::where('unit_price', '>', 0.99)
    //     //     ->orderBy('name')
    //     //     ->limit(5)
    //     //     ->get()
    //     'tracks' => Track::with(['genre', 'album'])
    //         ->where('unit_price', '>', 0.99)
    //         ->orderBy('name')
    //         ->get()
    // ]);

    return view('eloquent');
});
