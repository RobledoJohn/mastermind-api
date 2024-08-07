@extends('layouts.app')

@section('tittle', 'Empresas')

@section('content')
<div class="container-fluid">
  <h2>Listado de Empresas</h2>
  <br>
    <table class="table table-secondary">
      <thead>
        <tr class="table-primary">
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">nit</th>
          <th scope="col">email</th>
          <th scope="col">avatar</th>
          <th scope="col">direccion</th>
          <th scope="col">telefono</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        @forEach($empresas as $empresa)
        <tr>
          <th scope="row">{{$empresa->id}}</th>
          <td>{{$empresa->nombre}}</td>
          <td>{{$empresa->nit}}</td>
          <td>{{$empresa->email}}</td>
          <td>{{$empresa->avatar}}</td>
          <td>{{$empresa->direccion}}</td>
          <td>{{$empresa->telefono}}</td>
          <td>{{$empresa->estado}}</td>
        </tr>
        @endForEach
      </tbody>
    </table>
  </div>
@endsection