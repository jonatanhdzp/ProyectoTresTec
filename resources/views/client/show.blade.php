@extends('layouts.defaultHtml')

@section('title', '| Clientes')

@php
    session(['clients_previous_url' => session('clients_previous_url') ?? route('client.index')]);
@endphp

@section('content')

    <div class="container py-2">
        <div class="row d-flex">
            <div class="col-12">
                <a href="{{ session('clients_previous_url') ?? url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>{{ $client->name }}</h1>
                </div>
                <div class="row">

                    <div class="col-10">
                        <div class="row">
                            <x-dropdownForm :id="$client->id" color="warning" :action="route('client.update', $client)" method="PUT"
                                :fields="[
                                    [
                                        'label' => 'Nombre',
                                        'name' => 'name',
                                        'value' => $client->name,
                                        'required' => true
                                    ],
                                    [
                                        'label' => 'Correo',
                                        'name' => 'email',
                                        'value' => $client->email,
                                        'type' => 'email',
                                        'required' => true
                                    ],
                                    [
                                        'label' => 'Teléfono',
                                        'name' => 'phone',
                                        'value' => $client->phone,
                                    ],
                                ]" />
                        </div>
                    </div>
                    <div class="col-2">

                        <form action="{{ route('client.destroy', $client) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Eliminar a {{ $client->name }}?')">Eliminar</button>
                        </form>
                    </div>

                    <div class="col-12 mt-3">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong> {{ $client->id }}</li>
                            <li class="list-group-item"><strong>Nombre:</strong> {{ $client->name }}</li>
                            <li class="list-group-item"><strong>Correo:</strong> {{ $client->email }}</li>
                            <li class="list-group-item"><strong>Teléfono:</strong> {{ $client->phone }}</li>
                        </ul>
                    </div>

                </div>

            </div>

            <div class="col-6">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Contratos</h1>
                </div>

                <ul class="list-group">
                    @if ($contracts->isEmpty())
                        <h2>No hay contratos existentes</h2>
                    @else
                        @foreach ($contracts as $contract)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5>Contrato #{{ $contract->contract_number }}</h5>
                                    ${{ $contract->amount }}
                                </div>
                                <div class="d-flex justify-content-between">
                                    <small class="text-body-secondary">
                                        ({{ $contract->starts_at }} - {{ $contract->ends_at }})
                                    </small>
                                    <form class="d-inline" method="POST" action="{{ route('contract.destroy',$contract->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar contrato?')">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </ul>
                {{ $contracts->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
@endsection
