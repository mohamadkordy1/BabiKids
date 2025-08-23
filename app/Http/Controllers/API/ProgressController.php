<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress; // Assuming you have a Payment model
use App\Http\Resources\ProgressResource;
class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        // This method should return a list of progress records
        // Assuming you have a Progress model
        $progressRecords = Progress::all();

        // Return the progress records as a JSON response
               return ProgressResource::collection($progressRecords);

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
            'child_id' => 'required|exists:children,id', // Assuming you have a Child model
            'goal_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'status' => 'required|in:ongoing,completed,7-7-2025', //
            'notes' => 'nullable|string'
        ]);

        // Create a new progress record
        $progress = Progress::create($data);

        // Return a response
  return (new ProgressResource($progress))
            ->additional(['message' => 'progress created successfully'])
            ->response()
            ->setStatusCode(201);    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progress = Progress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }

        // Return the progress as a JSON response
          return new ProgressResource($progress);
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
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $data = $request->validate([
            'child_id' => 'required|exists:children,id', // Assuming you have a Child model
            'goal_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'status' => 'required|in:ongoing,completed,not_started', //
            'notes' => 'nullable|string'
        ]);

        // Find the progress record
        $progress = Progress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }

        // Update the progress record
        $progress->update($data);

        // Return a response
      
         return (new ProgressResource($progress))
            ->additional(['message' => 'Activity updated successfully']);  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the progress record
        $progress = Progress::find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }

        // Delete the progress record
        $progress->delete();

        // Return a response
        return response()->json(['message' => 'Progress record deleted successfully'], 200);
    }
}
