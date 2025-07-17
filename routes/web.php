<?php

use App\Http\Controllers\GameStatus\UpdateGameStatusController;
use App\Models\Game;
use App\Models\UserGameStatus;
use Illuminate\Support\Facades\Request;
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


Route::get('/game/{uuid}', function ($id) {
    $isLoggedIn = false;
    $user_id = "-1";
    if (Auth::check()) {
        $isLoggedIn = true;
        $user_id = Auth::id();
    }
    $game = Game::where('id', $id)->first();
    $status = UserGameStatus::where([
        'game_id' => $game->id,
        'user_id' => $user_id
    ])->first();
    return Inertia::render("game", [
        'game' => $game,
        'isLoggedIn' => $isLoggedIn,
        'status' => $status->status,
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

Route::get('/token', function (Request $request) {
    $token = csrf_token();
    return response()->json(['csrfToken' => $token]);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
