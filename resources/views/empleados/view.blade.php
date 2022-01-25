@extends('layouts.layout')
@section('titulo', 'Prima')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3 h1">Prima de {{ $Empleado->nombre }}</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title">Prima de servicios</div>
                    </div>
                    <!--body-->
                    <div class="card-body">
                        <div class="row">
                            <!--end card user-->
                            <div class="col-md-6 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Usuario:
                                                    {{ $Empleado->nombre }}</b></h5>
                                            </a>
                                            <p class="description">
                                                <td> <b>Nombre usuario: </b> {{ $Empleado->nombre }}<br></td>
                                                <td> <b>Cedula: </b> {{ $Empleado->cedula }}<br></td>
                                                <td> <b>Salario: </b> {{ number_format($Empleado->salario, 2, ',', '.') }}<br></td>
                                                <td> <b>Dias trabajados: </b> {{ $Empleado->dias }}<br></td>
                                                <td> <b>Prima de servicios: </b> {{ number_format($Empleado->prima, 2, ',', '.') }}<br></td>
                                                <td> <b>Auxilio de transporte: </b> {{ number_format($Empleado->auxilioTransporte, 2, ',', '.') }}<br></td>
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end card user 2-->
                            <div class="col-md-6 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Datos adicionales</b></h5>
                                            </a>
                                            <p class="description">
                                                <td> <b>Total de las primas: </b> {{ number_format($total, 2, ',', '.') }}<br></td>
                                                <td> <b>Promedio de las primas: </b> {{ number_format($promedio, 2, ',', '.') }}<br></td>
                                                <td> <b>Empleado con prima mayor: </b> {{ $nombreMayor }}<br></td>
                                                <td> <b>Empleado con prima menor: </b> {{ $nombreMenor }}<br></td>
                                                <td> <b>Cantidad de empleados: </b> {{ $contador }}<br></td>
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <a href="{{ route('empleados.index') }}" class="btn btn-primary mt-3">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
