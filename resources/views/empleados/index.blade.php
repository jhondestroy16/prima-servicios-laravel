@extends('layouts.layout')
@section('titulo', 'Empleados')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Empleados</h2>
    @if ($mensaje = Session::get('exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $mensaje }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-hover table-bordered table-striped alto-100">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Salario</th>
                <th>Dias trabajados</th>
                <th>Prima</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td> {{ $empleado->nombre }} </td>
                    <td> {{ $empleado->cedula }} </td>
                    <td> {{ $empleado->salario }} </td>
                    <td> {{ $empleado->dias }} </td>
                    <td> {{ $empleado->prima }} </td>
                    <td>
                        <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="post"
                            class="d-inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Desea eliminar el empleado  {{ $empleado->nombre }}?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{ $empleados->links() }}
        </ul>
    </nav>
@endsection
