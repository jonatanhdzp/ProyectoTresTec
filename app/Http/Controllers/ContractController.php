<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class ContractController extends Controller
{
    public function destroy(Contract $contract)
    {
        $clientId = $contract->client_id;
        $contract->delete();
        return redirect()->route('client.show', $clientId)->with('success', 'Contrato eliminado correctamente');
    }
}
