<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child; // Assuming you have a Child model
use App\Http\Resources\ChildResource; // Assuming you have a ChildResource for formatting responses

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        // This method should return a list of children
        // Assuming you have a Child model
        $children = Child::all();
        // Return the children as a JSON response
        return ChildResource::collection($children);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'parent_id' => 'required|exists:users,id', // Assuming you have a Parent model
        ]);
        

        // Create a new child record
        $child = Child::create($data);

        // Return a response
        return (new ChildResource($child))
            ->additional(['message' => 'Child created successfully'])
            ->response()
            ->setStatusCode(201);
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Child::find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }

        // Return the child as a JSON response
        return new ChildResource($child);
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
           'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'parent_id' => 'required|exists:users,id',]);

        // Find the child record
        $child = Child::find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }

        // Update the child record
        $child->update($data);

        // Return a response
        return (new ChildResource($child))
            ->additional(['message' => 'Child updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the child record
        $child = Child::find($id);
        if (!$child) {
            return response()->json(['message' => 'Child not found'], 404);
        }

        // Delete the child record
        $child->delete();

        // Return a response
        return response()->json(['message' => 'Child deleted successfully'], 200);
    }
}
