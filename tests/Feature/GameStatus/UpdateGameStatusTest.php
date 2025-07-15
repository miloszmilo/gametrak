<?php

use App\Models\Game;
use App\Models\User;

test('returns a successful search response', function () {
    $user = User::factory()->create();
    $game_id = Game::select('id')->first();

    $response = $this->actingAs($user)->get('/game/'. $game_id);

    $response
        ->assertDontSee('Plan to play')
        ->assertDontSee('Playing')
        ->assertDontSee('Completed')
        ->assertDontSee('Dropped')
        ->assertSessionHasNoErrors()
        ->assertOk();
});
