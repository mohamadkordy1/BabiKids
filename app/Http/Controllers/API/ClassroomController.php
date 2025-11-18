<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Http\Resources\ClassroomResource;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Repositories\ClassroomRepository;

class ClassroomController extends Controller
{
    protected $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    public function index()
    {
        return ClassroomResource::collection($this->classroomRepository->all());
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = $this->classroomRepository->create($request->validated());
        return (new ClassroomResource($classroom))
            ->additional(['message' => 'Classroom created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }
        return new ClassroomResource($classroom);
    }

    public function update(UpdateClassroomRequest $request, $id)
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $classroom = $this->classroomRepository->update($id, $request->validated());
        return (new ClassroomResource($classroom))
            ->additional(['message' => 'Classroom updated successfully']);
    }

    public function destroy($id)
    {
        $classroom = $this->classroomRepository->find($id);
        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        $this->classroomRepository->delete($id);
        return response()->json(['message' => 'Classroom deleted successfully'], 200);
    }

    // ------------------------------------------
    // CHILD MANAGEMENT
    // ------------------------------------------

    public function addChildren(Request $request, $classroomId)
    {
        $request->validate([
            'child_ids' => 'required|array',
            'child_ids.*' => 'exists:children,id',
        ]);

        $classroom = Classroom::find($classroomId);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);

        $classroom->children()->syncWithoutDetaching($request->child_ids);
        return response()->json(['message' => 'Children added successfully']);
    }

    public function removeChildren(Request $request, $classroomId)
    {
        $request->validate([
            'child_ids' => 'required|array',
            'child_ids.*' => 'exists:children,id',
        ]);

        $classroom = Classroom::find($classroomId);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);

        $classroom->children()->detach($request->child_ids);
        return response()->json(['message' => 'Children removed successfully']);
    }

    public function listChildren($classroomId)
    {
        $classroom = Classroom::with('children')->find($classroomId);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);

        return response()->json([
            'classroom' => $classroom->name,
            'children' => $classroom->children->pluck('name'),
        ]);
    }
}
