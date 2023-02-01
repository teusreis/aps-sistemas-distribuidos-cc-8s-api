<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdmRequest;
use App\Models\Donation;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', 'App\Models\User');

        return response()->json([
            'status' => 'ok',
            'data' => $this->service->getUsers($request->query())
        ]);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        $user->load('address');

        return response()->json([
            'status' => 'ok',
            'data' => [
                'user' => $user,
                'donation' => Donation::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10)
            ]
        ]);
    }

    public function me()
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->with('address')
            ->first();

        $this->authorize('view', $user);

        return response()->json([
            'status' => 'ok',
            'data' => [
                'user' => $user,
                'donation' => Donation::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10)
            ]
        ]);
    }

    public function create(CreateAdmRequest $request)
    {
        $this->authorize('create', 'App\Models\User');

        $user = $this->service->create($request->validated());

        return response()->json([
            'status' => 'ok',
            'message' => 'Administrador criado com sucesso',
            'user' => $user
        ]);
    }
}
