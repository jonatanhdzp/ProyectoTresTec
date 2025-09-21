<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Models\Contract;

class ContractApiController extends Controller
{
    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->validated());
        return response()->json($contract->load('client'), 201);
    }
}
