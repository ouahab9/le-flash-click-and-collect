<?php

use App\Models\User;

test('profile page is not publicly available', function () {
    $user = User::factory()->create([
        'is_admin' => true,
    ]);

    $this->actingAs($user);

    $this->get('/profile')
        ->assertNotFound();
});
