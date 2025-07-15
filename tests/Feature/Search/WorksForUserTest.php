<?php

use App\Models\User;

test('returns a successful search response', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/search/test');

    $response
        ->assertSessionHasNoErrors()
        ->assertOk();
});

test('returns correct items for \'dark\'', function () {
    $response = $this->get('/search/dark');

    $response
        ->assertSessionHasNoErrors()
        ->assertOk()
        ->assertSee('Dark Souls', 'Dark Messiah of Might and Magic');
});
