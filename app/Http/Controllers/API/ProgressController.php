<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress; // Assuming you have a Payment model
use App\Http\Resources\ProgressResource;
use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Repositories\ProgressRepository;

class ProgressController extends Controller
{
public $progressRepository;
    public function __construct(ProgressRepository $progressRepository)
    {
        $this->progressRepository = $progressRepository;
    }
    


    public function index()
    {
       
    return ProgressResource::collection($this->progressRepository->all());
       
    }

    public function store(StoreProgressRequest $request)
    {
        $progress = $this->progressRepository->create($request->validated());

        // Return a response
  return (new ProgressResource($progress))
            ->additional(['message' => 'Progress record created successfully'])
           ;
        }

    public function show(string $id)
    {
        $progress = $this->progressRepository->find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }
        $Progress = Progress::find($id);
        return new ProgressResource($Progress);
    }

    public function update(UpdateProgressRequest $request, string $id)
    {
        $progress = $this->progressRepository->find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }

        $updatedProgress = $this->progressRepository->update($id, $request->validated());

        return (new ProgressResource($updatedProgress))
            ->additional(['message' => 'Progress record updated successfully'])
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $progress = $this->progressRepository->find($id);
        if (!$progress) {
            return response()->json(['message' => 'Progress record not found'], 404);
        }

        $this->progressRepository->delete($id);

        return response()->json(['message' => 'Progress record deleted successfully']);
    }
}
