<?php

use App\Models\Game;
use App\Models\User;

test('dont return option to update game status', function () {
    $game_id = Game::select('id')->first();

    $response = $this->get("/game/$game_id");

    $response
        ->assertInertia(fn ($page) => $page->where('isLoggedIn', false))
        ->assertSessionHasNoErrors()
        ->assertOk();
});

test('returns option to update game status', function () {
    $user = User::factory()->create();

    $game_id = Game::select('id')->first()->id;

    $response = $this->actingAs($user)->get("/game/$game_id");

    $response
        ->assertInertia(fn ($page) => $page->where('isLoggedIn', true))
        ->assertSessionHasNoErrors()
        ->assertOk();
});
