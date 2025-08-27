<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\User;
class UserController extends Controller
{

    public $userRepository;
  public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        
         return UserResource::collection($this->userRepository->all());


    }

    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'user member not found'], 404);
        }
        $user = User::find($id);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
         $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'user member not found'], 404);
        }

        $updateduser = $this->userRepository->update($id, $request->validated());
        return (new UserResource($updateduser))
            ->additional(['message' => 'user member updated successfully'])
            ->response()
            ->setStatusCode(200);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   $user = $this->userRepository->find($id);
        if (!$user) {
            return response()->json(['message' => 'user member not found'], 404);
        }

        $this->userRepository->delete($id);

        return response()->json(['message' => 'user member deleted successfully'], 200);
    
        

    }
}
