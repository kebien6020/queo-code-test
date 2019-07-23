<?php

use Illuminate\Database\Seeder;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Empresa::class, 20)->create()->each(function ($empresa) {
            for ($i = 0; $i < 10; ++$i) {
                $empresa->empleados()->save(factory(App\Empleado::class)->make());
            }
        });
    }
}
