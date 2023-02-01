<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(CreateAddressRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $address = Address::create($data);

        return response()->json([
            'status' => 'ok',
            'message' => 'Endereço registrado com sucesso',
            'data' => $address
        ], 201);
    }
}
