<?php

test('public registration is disabled', function () {
    $this->get('/register')
        ->assertNotFound();
});
