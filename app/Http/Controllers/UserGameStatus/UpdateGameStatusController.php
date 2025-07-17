<?php

namespace App\Http\Controllers\UserGameStatus;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\UserGameStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

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
        $integer_status = $this->statusToInteger($status);

        UserGameStatus::updateOrCreate(
            ['user_id' => $user_id, 'game_id' => $game_id],
            ['status' => $integer_status]
        );

        return response(200);
        // return back()->with('status', 'updated successfully');
        // return back();
    }

    private function statusToInteger(string $status): int {
        switch ($status) {
            case 'not planning':
                return 0;
                break;
            case 'planning':
                return 1;
                break;
            case 'playing':
                return 2;
                break;
            case 'completed':
                return 3;
                break;
            case 'dropped':
                return 4;
                break;
            default:
                return 0;
                break;
        }
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
