@extends('layouts.app')

@section('tittle', 'Tecnicos')

@section('content')
<div class="container-fluid">
  <h2>Listado de Técnicos</h2>
  <br>
    <table class="table table-secondary">
      <thead>
        <tr class="table-primary">
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">email</th>
          <th scope="col">avatar</th>
          <th scope="col">telefono</th>
          <th scope="col">Empresa</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        @forEach($tecnicos as $data)
        <tr>
          <th scope="row">{{$data->id}}</th>
          <td>{{$data->nombre}}</td>
          <td>{{$data->email}}</td>
          <td>{{$data->avatar}}</td>
          <td>{{$data->telefono}}</td>
          <td>{{$data->empresas->nombre}}</td>
          <td>{{$data->estado}}</td>
        </tr>
        @endForEach
      </tbody>
    </table>
</div>
@endsection