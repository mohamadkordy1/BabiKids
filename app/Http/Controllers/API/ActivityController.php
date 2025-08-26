<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity; // Assuming you have an Activity model
use App\Http\Resources\ActivityResource; // Assuming you have an ActivityResource for formatting responses
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ActivityRepository;

class ActivityController extends Controller
{
    
    public $activityRepository;
    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }






    public function index()
    {
       return ActivityResource::collection($this->activityRepository->all());

    }


    public function store(StoreActivityRequest $request)
    {
        $activity = $this->activityRepository->create($request->validated());

      return (new ActivityResource($activity))
            ->additional(['message' => 'activity created successfully'])
            ->response()
            ->setStatusCode(201);
    }


    public function show(string $id)
    {
        $activity = $this->activityRepository->find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $Activity = Activity::find($id);
        return new ActivityResource($Activity);

}

    
    public function update(UpdateActivityRequest $request, string $id)
    {
        $activity = $this->activityRepository->find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        // Update the activity with validated data
        $activity=$this->activityRepository->update($id, $request->validated());

        // Return a response
       return (new ActivityResource($activity))
            ->additional(['message' => 'Activity updated successfully'])
            ->response()
            ->setStatusCode(200);
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $activity = $this->activityRepository->find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $this->activityRepository->delete($id);

        return response()->json(['message' => 'Activity deleted successfully']);
    }
}
