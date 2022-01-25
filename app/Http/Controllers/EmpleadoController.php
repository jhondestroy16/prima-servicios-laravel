<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::orderBy('nombre','asc')->simplePaginate(5);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmpleadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salarioMinimo = 1_000_000;
        $auxilioTransporte = 0;
        $prima = 0;

        $request->validate([
            'nombre' => ['required'],
            'cedula' => ['required'],
            'salario' => ['required'],
            'dias' => ['required']
        ]);

        $empleado = Empleado::create($request->all());

        $id = $empleado->id;
        $Empleado = Empleado::findOrFail($id);

        if (($Empleado->salario) < ($salarioMinimo * 2)) {
            $auxilioTransporte = 97_032;
            $Empleado->salario += $auxilioTransporte;
        }

        if ($Empleado->dias <= 179) {
            $prima = ($Empleado->salario * $Empleado->dias) / 360;
        } else {
            $prima = ($Empleado->salario / 2);
        }
        DB::table('empleados')
            ->where('id', $id)
            ->update(['prima' => $prima]);
        DB::table('empleados')
            ->where('id', $id)
            ->update(['auxilioTransporte' => $auxilioTransporte]);
        return redirect()->route('empleados.index')->with('exito', 'Se ha registrado el empleado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados = Empleado::all();
        $Empleado = Empleado::findOrFail($id);
        //--------------------------------------//
        $alta = 0;
        $baja = 999_999_999;
        $total = 0;
        $nombreMayor = "";
        $nombreMenor = "";
        $promedio = 0;
        $contador = 0;
        foreach ($empleados as $empleado) {
            $contador++;
            if (($empleado->prima) > $alta) {
                $alta = $empleado->prima;
                $nombreMayor = $empleado->nombre;
            }
            if (($empleado->prima) < $baja) {
                $baja = $empleado->prima;
                $nombreMenor = $empleado->nombre;
            }

            $total += $empleado->prima;
            $promedio = ($total / $contador);
        }

        return view('empleados.view', compact('empleados', 'Empleado', 'nombreMayor', 'nombreMenor', 'total', 'promedio','contador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);

        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmpleadoRequest  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $salarioMinimo = 1_000_000;
        $auxilioTransporte = 0;
        $prima = 0;

        $request->validate([
            'nombre' => ['required'],
            'cedula' => ['required'],
            'salario' => ['required'],
            'dias' => ['required']
        ]);

        $Empleado = Empleado::findOrFail($id);
        $Empleado->update($request->all());

        if (($Empleado->salario) < ($salarioMinimo * 2)) {
            $auxilioTransporte = 97_032;
            $Empleado->salario += $auxilioTransporte;
        }

        if ($Empleado->dias <= 179) {
            $prima = ($Empleado->salario * $Empleado->dias) / 360;
        } else {
            $prima = ($Empleado->salario / 2);
        }
        DB::table('empleados')
            ->where('id', $id)
            ->update(['prima' => $prima]);
        DB::table('empleados')
            ->where('id', $id)
            ->update(['auxilioTransporte' => $auxilioTransporte]);
        return redirect()->route('empleados.index')->with('exito', 'Se ha modificado los datos del empleado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado = Empleado::findOrFail($empleado->id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('exito', 'Se ha eliminado el empleado exitosamente');
    }
}
