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
    if (!$status) {
        $status = new stdClass();
        $status->status = 'not planning';
        $status->rating = '';
        $status->playtime = '';
    }
    return Inertia::render("game", [
        'game' => $game,
        'isLoggedIn' => $isLoggedIn,
        '_status' => $status->status,
        '_rating' => $status->rating,
        '_playtime' => $status->playtime,
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
        $user_id = Auth::id();
        $username = "John Schmoe";
        $games = DB::table('user_game_statuses')
            ->join('games', 'games.id','=','game_id')
            ->where('user_id', '=', $user_id)
            ->get();
        return Inertia::render('dashboard', [
            'games' => $games,
            'username' => $username
        ]);
    })->name('dashboard');
});

Route::get('/token', function (Request $request) {
    $token = csrf_token();
    return response()->json(['csrfToken' => $token]);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
