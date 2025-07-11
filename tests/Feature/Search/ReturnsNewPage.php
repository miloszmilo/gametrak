<?php

it('returns a successful search response', function () {
    $response = $this->get('/search/test');

    $response->assertStatus(200);
});
