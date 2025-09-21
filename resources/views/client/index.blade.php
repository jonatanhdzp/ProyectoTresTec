@extends('layouts.defaultHtml')
@php
    session(['clients_previous_url' => request()->fullUrl()]);
@endphp

@section('title', '| Clientes')

@section('content')

    <div class="container py-2">
        <div class="d-flex justify-content-evenly align-items-center mb-3">
            <h1>Clientes</h1>
            <x-dropdownForm id="AddNewClient" color="primary" title="Nuevo cliente" :action="route('client.store')" method="POST" :fields="[
                ['label' => 'Nombre', 'name' => 'name', 'required' => true],
                ['label' => 'Correo', 'name' => 'email', 'type' => 'email', 'required' => true],
                ['label' => 'Teléfono', 'name' => 'phone', 'required' => false]
            ]" />
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('client.index') }}" class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control"
                            placeholder="Nombre">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="email" value="{{ request('email') }}" class="form-control"
                            placeholder="Email">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="phone" value="{{ request('phone') }}" class="form-control"
                            placeholder="Teléfono">
                    </div>
                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                        <a href="{{ route('client.index') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>
                                <a href="{{ route('client.show', $client) }}" class="btn btn-info btn-sm">Ver</a>
                                <form action="{{ route('client.destroy', $client) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar cliente?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $clients->links('pagination::bootstrap-5') }}
    </div>

@endsection
