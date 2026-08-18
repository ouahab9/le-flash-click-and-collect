<?php

use App\Models\User;
use Livewire\Volt\Volt;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response
        ->assertOk()
        ->assertSeeVolt('pages.auth.login');
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create([
        'is_admin' => true,
    ]);

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    $component->call('login');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $component = Volt::test('pages.auth.login')
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password');

    $component->call('login');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('non admin users cannot access dashboard', function () {
    $user = User::factory()->create([
        'is_admin' => false,
    ]);

    $this->actingAs($user);

    $this->get('/dashboard')
        ->assertForbidden();
});

test('admin users can access dashboard', function () {
    $user = User::factory()->create([
        'is_admin' => true,
    ]);

    $this->actingAs($user);

    $this->get('/dashboard')
        ->assertOk();
});

test('users can logout', function () {
    $user = User::factory()->create([
        'is_admin' => true,
    ]);

    $this->actingAs($user);

    $response = $this->post('/logout');

    $response->assertRedirect('/');

    $this->assertGuest();
});
