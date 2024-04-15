<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\{
    StoreUserRequest,
    UpdateUserRequest
};

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->userService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        return $this->userService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user_id)
    {
        return $this->userService->show($user_id, request()->route('action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $user_id)
    {
        return $this->userService->update($request, $user_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user_id)
    {
        return $this->userService->destroy($user_id);
    }
}
