<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff; // Assuming you have a Staff model
use App\Models\User; // Assuming you have a User model
use App\Http\Resources\StaffResource;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Repositories\StaffRepository;

class StaffController extends Controller
{public $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }


    public function index()
    {
      return StaffResource::collection($this->staffRepository->all());}

    

    public function store(StoreStaffRequest $request)
    {
        // Create a new staff member
        $staff = $this->staffRepository->create($request->validated());

        // Return a response
       return (new StaffResource($staff))
            ->additional(['message' => 'staff created successfully'])
            ->response()
            ->setStatusCode(201);
    }

   
    public function show(string $id)
{
        $staff = $this->staffRepository->find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }
        $Staff = Staff::find($id);
        return new StaffResource($Staff);
    }



    public function update(UpdateStaffRequest $request, string $id)
    {
        $staff = $this->staffRepository->find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        $updatedStaff = $this->staffRepository->update($id, $request->validated());
        return (new StaffResource($updatedStaff))
            ->additional(['message' => 'Staff member updated successfully'])
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(string $id)
    {
        $staff = $this->staffRepository->find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        $this->staffRepository->delete($id);

        return response()->json(['message' => 'Staff member deleted successfully'], 200);
    }
}
