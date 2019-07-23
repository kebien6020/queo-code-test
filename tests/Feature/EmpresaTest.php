<?php

namespace Tests\Feature;

use App\User;
use App\Empresa;
use DatabaseSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpresaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        (new DatabaseSeeder())->run();
    }

    private function login()
    {
        $user = User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('contraseña'),
        ]);

        return $this->actingAs($user);
    }

    public function testCompanyList()
    {
        $response = $this->login()->get(route('empresas.index'));

        $response->assertStatus(200);
        $response->assertViewHas('empresas');
        $response->assertSeeInOrder([
            '<tr', '<tr', '<tr', '<tr', '<tr',
            '<tr', '<tr', '<tr', '<tr', '<tr',
        ]);
        $response->assertSee('Crear Empresa');
    }

    public function testCompanyCreate()
    {
        $response = $this->login()->get(route('empresas.create'));

        $response->assertStatus(200);
        $response->assertViewMissing('empresa');
        $response->assertSeeInOrder(['<form', 'Nombre', 'Correo', 'Logo', 'Sitio', 'Crear']);
    }

    public function testCompanyStore()
    {
        $response = $this->login()->post(route('empresas.store'), [
            'name' => 'Empresa Prueba',
            'email' => 'emp@test.com',
            'website' => 'https://google.com',
        ]);

        $this->assertDatabaseHas('empresas', [
            'name' => 'Empresa Prueba',
            'email' => 'emp@test.com',
            'logo' => null,
            'website' => 'https://google.com',
        ]);
    }

    public function testCompanyStoreValidation()
    {
        $response = $this->login()->post(route('empresas.store'), [
            // missing name
            'email' => 'emp@test.com',
            'website' => 'https://google.com',
        ]);

        $response->assertSessionHasErrors();
    }

    public function testCompanyEditShowsOldData()
    {
        $empresa = Empresa::first();

        $response = $this->login()->get(route('empresas.edit', $empresa->id));

        $response->assertViewHas('edit', true);
        $response->assertViewHas('empresa');
        $response->assertSeeInOrder([
            $empresa->name,
            $empresa->email,
            $empresa->website,
        ]);
    }
}
