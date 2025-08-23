<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff; // Assuming you have a Staff model
use App\Models\User; // Assuming you have a User model
use App\Http\Resources\StaffResource;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all staff members
        $staff = Staff::all();

        // Return the staff members as a JSON response
                       return StaffResource::collection($staff);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        // Validate the request data
        $data = $request->validate([
            'user_id' => 'required|exists:users,id', // Assuming you have a User model
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'hired_date' => 'required|date',
        ]);

        // Create a new staff member
        $staff = Staff::create($data);

        // Return a response
      return (new StaffResource($staff))
            ->additional(['message' => 'Staff created successfully'])
            ->response()
            ->setStatusCode(201); }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function show(string $id)
{
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        // Return the staff member as a JSON response
          return new StaffResource($staff);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        // Validate the request data
        $data = $request->validate([
            'user_id' => 'required|exists:users,id', // Assuming you have a User model
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'hired_date' => 'required|date',
        ]);

        // Find the staff member
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        // Update the staff member
        $staff->update($data);

        // Return a response
     
         return (new StaffResource($staff))
            ->additional(['message' => 'staff updated successfully']); }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        // Find the staff member
        $staff = Staff::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        // Delete the staff member
        $staff->delete();

        // Return a response
        return response()->json(['message' => 'Staff member deleted successfully'], 200);
    }
}
