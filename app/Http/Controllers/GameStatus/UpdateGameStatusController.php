<?php

namespace App\Http\Controllers\GameStatus;

use App\Http\Controllers\Controller;
use App\Models\UserGameStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

$GAME_STATUSES = ['planning', 'playing', 'completed', 'dropped'];

class UpdateGameStatusController extends Controller {
    /**
     * Updates game status for user
     */
    public function store(Request $request): Response {
        $request->validate([
            'game_id' => ['required', 'uuid:4', 'size:36'],
            'status' => ['required', Rule::in(GAME_STATUSES)],
        ]);

        $user_id = $request->user()->id;
        $game_id = $request->string('game_id')->trim();
        $status = $request->string('status')->trim();

        UserGameStatus::updateOrCreate([
            ['user_id' => $user_id, 'game_id' => $game_id],
            ['status' => $status]
        ]);
    }
    public function show(Request $request): Response {
        $loggedIn = false;
        if (Auth::check()) {
            $loggedIn = true;
        }
        Inertia::render('/game/' . $request->string('uuid'), ['isLoggedIn' => isLoggedIn]);

    }
}
