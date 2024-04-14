<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if ($request->has('search') || $request->has('page')) {
            return response()->json([
                'table_data' => view('components.table', $this->userRepository->getUsersPaginated())->render(),
            ]);
        }

        return view('users.index', $this->userRepository->getUsersPaginated());
    }

    public function store(StoreUserRequest $request)
    {
        $data = [
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->date_of_birth,
        ];

        $this->userRepository->storeUser($data);

        return response()->json([
            'table_data' => view('components.table', $this->userRepository->getUsersPaginated())->render(),
        ]);
    }
}
