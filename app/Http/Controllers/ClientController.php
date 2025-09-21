<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Contract;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::query()
            ->when($request->name, fn($q, $name) => $q->where('name', 'like', "%{$name}%"))
            ->when($request->email, fn($q, $email) => $q->where('email', 'like', "%{$email}%"))
            ->when($request->phone, fn($q, $phone) => $q->where('phone', 'like', "%{$phone}%"))
            ->paginate(3)
            ->appends($request->all());

        return view('client.index', compact('clients'));
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('client.index')->with('success', 'Cliente creado correctamente');
    }

    public function show(Client $client)
    {
        $contracts = Contract::where('client_id', $client->id)
            ->paginate(3);

        return view('client.show', compact('client', 'contracts'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return redirect(url()->previous())->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect(session('clients_previous_url') ?? url()->previous())->with('success', 'Cliente eliminado correctamente');
    }
}
