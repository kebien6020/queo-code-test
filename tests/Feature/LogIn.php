<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogIn extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRootRedirectsToHome()
    {
        $response = $this->get('/');

        $response->assertRedirect('/home');
    }

    public function testHomeRedirectsToLogin()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function testLoginContainsForm()
    {
        $response = $this->get('/login');

        $response->assertSeeInOrder(['<form', 'Sign In']);
    }

    public function testLoginAuthenticates()
    {
        User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('contraseña'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@test.com',
            'password' => 'contraseña',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('/home');
    }
}
