<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Register extends TestCase
{
    public function testRegisterIsNotEnabled()
    {
        $response = $this->get('/register');

        $response->assertNotFound();
    }
}
