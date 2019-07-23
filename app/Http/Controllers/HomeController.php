<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Empleado;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresas_count = Empresa::count();
        $empleados_count = Empleado::count();
        return view('home', [
            'empresas_count' => $empresas_count,
            'empleados_count' => $empleados_count,
        ]);
    }
}
