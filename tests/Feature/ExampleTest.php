<?php

it('returns a successful response', function () {
    $response = $this->get('/healthz');

    $response->assertStatus(200);
});
