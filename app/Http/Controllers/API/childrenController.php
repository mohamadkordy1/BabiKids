<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child; // Assuming you have a Child model
use App\Http\Resources\ChildResource; // Assuming you have a ChildResource for formatting responses
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\repositories\ChildRepository;


class ChildrenController extends Controller
{


    public $childRepository;

    public function __construct(ChildRepository $childRepository)
    {
        $this->childRepository = $childRepository;
    }



    public function index()
    {
       
        return ChildResource::collection($this->childRepository->all());
    }

    
    public function store(StoreChildRequest $request)
    {
   
        $child = $this->childRepository->create($request->validated());


        return (new ChildResource($child))
            ->additional(['message' => 'Child created successfully'])
            ->response()
            ->setStatusCode(201);
    
    
    }

    


    public function show(string $id)
    {
        $child = $this->childRepository->find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }
        $Child = Child::find($id);
        return new ChildResource($Child);
    }

    



    public function update(UpdateChildRequest $request, string $id)
    {
       

        $child = $this->childRepository->find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }
    $child = $this->childRepository->update($id, $request->validated());

        return (new ChildResource($child))
            ->additional(['message' => 'Child updated successfully']);
    }

    




    public function destroy(string $id)
    {
        // Find the child record
        $child = $this->childRepository->find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }

        // Delete the child record
$this->childRepository->delete($id);
        // Return a response
        return response()->json(['message' => 'Child deleted successfully'], 200);
    }
}
