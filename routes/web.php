<?php

use App\Models\Game;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

# HACK: get all games list to find the uuid
Route::get('/games', function () {
    $games = Game::all();
    return Inertia::render('games', [
        'games' => $games,
    ]);
})->name('all_games');

Route::get('/game/{id}', function ($id) {
    $game = Game::where('id', $id)->first();
    return Inertia::render('game', [
        'id' => $id,
        'game' => $game,
    ]);
})->name('game');

Route::get('/search/{name}', function ($name) {
    $games = Game::where('name', 'LIKE', '%' . $name . '%')->get();
    return Inertia::render('search', [
        'games' => $games,
    ]);
})->name('search');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
