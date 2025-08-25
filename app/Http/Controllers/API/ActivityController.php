<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; // Assuming you have an Activity model
use App\Http\Resources\ActivityResource; // Assuming you have an ActivityResource for formatting responses
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all activities
        $Activities = Activity::all();

        // Return the activities as a JSON response
                return ActivityResource::collection($Activities);

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
    public function store(StoreActivityRequest $request)
    {
        
        // Validate the request data
       

        // Create a new activity
        $activity = Activity::create($request->validated());

        // Return a response
      return (new ActivityResource($activity))
            ->additional(['message' => 'activity created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $activities = Activity::find($id);
        if (!$activities) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        // Return the activity as a JSON response
 return new ActivityResource($activities);    }

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
    public function update(UpdateActivityRequest $request, string $id)
    {
        // Find the activity
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        

        // Update the activity
        $activity->update($request->validated());

        // Return a response
  return (new ActivityResource($activity))
            ->additional(['message' => 'Activity updated successfully']);      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        // Find the activity
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        // Delete the activity
        $activity->delete();

        // Return a response
        return response()->json(['message' => 'Activity deleted successfully'], 200);
    }
}
