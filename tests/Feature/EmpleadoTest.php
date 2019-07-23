<?php

namespace Tests\Feature;

use App\User;
use App\Empresa;
use App\Empleado;
use DatabaseSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmpleadoTest extends TestCase
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
        $response = $this->login()->get(route('empleados.index'));

        $response->assertStatus(200);
        $response->assertViewHas('empleados');
        $response->assertSeeInOrder([
            '<tr', '<tr', '<tr', '<tr', '<tr',
            '<tr', '<tr', '<tr', '<tr', '<tr',
        ]);
        $response->assertSee('Crear Empleado');
    }

    public function testCompanyCreate()
    {
        $response = $this->login()->get(route('empleados.create'));

        $response->assertStatus(200);
        $response->assertViewMissing('empleado');
        $response->assertSeeInOrder(['<form', 'Nombre', 'Apellido', 'Correo', 'Teléfono', 'Empresa', 'Crear']);
    }

    public function testCompanyStore()
    {
        $empresa = Empresa::first();

        $response = $this->login()->post(route('empleados.store'), [
            'first_name' => 'Pepito',
            'last_name' => 'Perez',
            'email' => 'pepe@test.com',
            'company_id' => $empresa->id,
        ]);

        $this->assertDatabaseHas('empleados', [
            'first_name' => 'Pepito',
            'last_name' => 'Perez',
            'email' => 'pepe@test.com',
            'phone' => null,
            'company_id' => $empresa->id,
        ]);
    }

    public function testCompanyStoreValidation()
    {
        $empresa = Empresa::first();

        $response = $this->login()->post(route('empleados.store'), [
            'first_name' => 'Pepito',
            // missing last_name
            'email' => 'pepe@test.com',
            'company_id' => $empresa->id,
        ]);

        $response->assertSessionHasErrors();
    }

    public function testCompanyEditShowsOldData()
    {
        $empleado = Empleado::first();

        $response = $this->login()->get(route('empleados.edit', $empleado->id));

        $response->assertViewHas('edit', true);
        $response->assertViewHas('empleado');
        $response->assertSeeInOrder([
            $empleado->first_name,
            $empleado->last_name,
            $empleado->email,
            $empleado->empresa->name,
        ]);
    }
}
