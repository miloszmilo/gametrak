<?php

namespace App\Http\Controllers\GameStatus;

use App\Http\Controllers\Controller;
use App\Models\UserGameStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

$GAME_STATUSES = ['planning', 'playing', 'completed', 'dropped'];

class UpdateGameStatusController extends Controller {
    /**
     * Show the user's password settings page.
     */
    public function store(Request $request): Response {
        /* get game id
        get game status
        update status if exists in table
        else create new entry */
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

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
}
