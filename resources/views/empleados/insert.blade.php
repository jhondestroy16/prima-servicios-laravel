@extends('layouts.layout')

@section('titulo', 'Crear empleado')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Registrar nuevo empleado</h2>
    @if ($errors->any())

        <div class="alert alert-danger">
            <div class="header">
                <strong>Ups...</strong>algo salio mal
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <form action="{{ route('empleados.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="card mt-4 mb-3">
            <div class="card-body shadow">
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="nombre" class="form-label texto my-2">
                                <h4 class="texto">Nombre</h4>
                            </label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre del empleado"
                                class="form-control" value="{{ old('nombre') }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="cedula" class="form-label texto my-2">
                                <h4 class="texto">Cedula</h4>
                            </label>
                            <input type="number" name="cedula" id="cedula"
                                placeholder="Cedula" class="form-control"
                                value="{{ old('cedula') }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="salario" class="form-label texto my-2">
                                <h4 class="texto">Salario</h4>
                            </label>
                            <input type="text" name="salario" id="salario" placeholder="Salario"
                                class="form-control" value="{{ old('salario') }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="dias" class="form-label texto my-2">
                                <h4 class="texto">Dias trabajados</h4>
                            </label>
                            <input type="number" name="dias" id="dias" placeholder="Dias trabajados por el empleado"
                                class="form-control" value="{{ old('dias') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary my-4"> Guardar </button>
        </div>
    </form>
@endsection
