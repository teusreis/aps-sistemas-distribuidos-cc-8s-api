<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDonation;
use App\Http\Requests\UpdateDonationStatus;
use App\Models\Donation;
use App\Services\DonationService;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    private DonationService $service;

    public function __construct()
    {
        $this->service = new DonationService();
    }

    public function index()
    {
        $this->authorize('viewAny', 'App\Models\Donation');

        return response()->json([
            'status' => 'ok',
            'data' => $this->service->getDonationPaginate()
        ]);
    }

    public function myDonation()
    {
        return response()->json([
            'status' => 'ok',
            'data' => $this->service->getDonationByUserId(auth()->id())
        ]);
    }

    public function create(CreateDonation $request)
    {
        $donation = auth()
            ->user()
            ->donations()
            ->create($request->validated());

        return response()->json([
            'status' => 'ok',
            'message' => 'Doação feita com sucesso',
            'data' => $donation
        ]);
    }

    public function update(Donation $donation, UpdateDonationStatus $request)
    {
        $this->authorize('update', $donation);

        $data = $request->validated();

        $donation->update($data);

        $message = $data['status'] === 'a'
            ? 'Doação aprovada com sucesso'
            : 'Doação recusada com sucesso';

        return response()->json([
            'status' => 'ok',
            'message' => $message
        ]);
    }
}
