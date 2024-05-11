<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\{
    StoreUserRequest,
    UpdateUserRequest
};

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

        return view('users.index', ["users" => [], "pagination" => []]);
    }

    // get data for user and prepare the modal
    public function show(int $userId, string $action = 'edit')
    {
        if($action === 'reset-modal'){
            return response()->json([
                'user_data' => view('components.modal')->render(),
            ]);
        }
        else if($action === 'delete'){
            return response()->json([
                'user_data' => view('components.delete-modal', $this->userRepository->getUser($userId))->render(),
            ]);
        }
        return response()->json([
            'user_data' => view('components.modal', $this->userRepository->getUser($userId))->render(),
        ]);
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

    public function update(UpdateUserRequest $request, int $userId)
    {
        $data = [
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->date_of_birth,
        ];

        $this->userRepository->updateUser($data, $userId);

        return response()->json([
            'modal_data' => view('components.modal')->render(),
        ]);
    }

    public function destroy(int $userId)
    {
        return $this->userRepository->deleteUser($userId);
    }
}
