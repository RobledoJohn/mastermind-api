@extends('layouts.app')

@section('tittle', 'Ordenes')

@section('content')
<div class="container-fluid">
  <h2>Listado de Ordenes</h2>
  <br>
    <table class="table table-secondary">
      <thead>
        <tr class="table-primary">
          <th scope="col">ID</th>
          <th scope="col">Fecha</th>
          <th scope="col">Estado</th>
          <th scope="col">Tecnico</th>
          <th scope="col">Modelo</th>
          <th scope="col">Cliente</th>
          <th scope="col">Telefono</th>
          <th scope="col">Enlace</th>
        </tr>
      </thead>
      <tbody>
        @forEach($ordenes as $orden)
        <tr>
          <th scope="row">{{$orden->id}}</th>
          <td>{{$orden->fecha}}</td>
          <td>{{$orden->enum_estado_reparacion}}</td>
          <td>{{$orden->tecnicos->nombre}}</td>
          <td>{{$orden->equipos->modelos->nombre}}</td>
          <td>{{$orden->equipos->clientes->nombre}}</td>
          <td>{{$orden->equipos->clientes->telefono}}</td>
          <td><a href="{{route('welcome')}}">{{$orden->enlace_seguimiento}}</a></td>
        </tr>
        @endForEach
      </tbody>
    </table>
  </div>
@endsection