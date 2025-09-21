<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientApiController extends Controller
{
    public function index()
    {
        return Client::with('contracts')->get();
    }
}
