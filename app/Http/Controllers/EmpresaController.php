<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::paginate(10);
        return view('empresas.list', [
            'empresas' => $empresas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create', ['edit' => false]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'nullable|email',
            'logo'    => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);

        if ($request->has('logo')) {
             $filename = $request->file('logo')->store('public');
             $data['logo'] = str_replace('public', '/storage', $filename);
        }

        $empresa = Empresa::create($data);

        return redirect()->route('empresas.show', $empresa->id)
            ->with('success', 'Empresa creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', [
            'empresa' => $empresa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.create', [
            'edit' => true,
            'empresa' => $empresa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'nullable|email',
            'logo'    => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ]);

        if ($request->has('logo')) {
             $filename = $request->file('logo')->store('public');
             $data['logo'] = str_replace('public', '/storage', $filename);
        } else {
            $data['logo'] = $empresa->logo;
        }

        $empresa->update($data);

        return redirect()->route('empresas.show', $empresa->id)
            ->with('success', 'Empresa guardada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa eliminada');
    }
}
