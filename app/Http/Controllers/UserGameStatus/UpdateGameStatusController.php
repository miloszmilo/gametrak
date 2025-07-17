<?php

namespace App\Http\Controllers\UserGameStatus;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\UserGameStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

const VALID_GAME_STATUSES = ['not planning', 'planning', 'playing', 'completed', 'dropped'];

class UpdateGameStatusController extends Controller {
    /**
     * Updates game status for user
     */
    public function store(Request $request): Response {
        $request->validate([
            'game_id' => ['required', 'uuid:7', 'size:36'],
            'status' => ['required', Rule::in(VALID_GAME_STATUSES)],
        ]);

        $user_id = Auth::id();
        $game_id = $request->string('game_id')->trim();
        $status = $request->string('status')->trim();

        $db_query_status = UserGameStatus::updateOrCreate(
            ['user_id' => $user_id, 'game_id' => $game_id],
            ['status' => $status]
        );

        if ($db_query_status->id) {
            return response(200);
        }
        return response(500);
    }

    /**
    * Show game status if user logged in
    */
    public function show(Request $request): Response {
        $isLoggedIn = false;
        if (Auth::check()) {
            $isLoggedIn = true;
        }
        $game = Game::where('id', $request->string('id'))->first();
        return Inertia::render("game", [
            'id' => $request->string('id'),
            'game' => $game,
            'isLoggedIn' => $isLoggedIn
        ]);

    }
}
