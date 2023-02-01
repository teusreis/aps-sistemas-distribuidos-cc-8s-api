<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers($data)
    {
        return User::query()
            ->when(isset($data['type']), fn ($query) => $query->where('type', $data['type']))
            ->paginate(10);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['type'] = 'adm';

        return User::create($data);
    }
}
