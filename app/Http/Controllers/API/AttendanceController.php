<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance; // Assuming you have an Attendance model
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all attendance records
        $attendanceRecords = Attendance::all();

        // Return the attendance records as a JSON response
                return AttendanceResource::collection($attendanceRecords);

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
            'child_id' => 'required|exists:children,id', // Assuming you have a Child model
            'date' => 'required|date',
            'status' => 'required|in:present,absent', // Assuming status can be present or absent
           
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            // Assuming you have a User model
        ]);

        // Create a new attendance record
        $attendance = Attendance::create($data);

        // Return a response
      return (new AttendanceResource($attendance))
            ->additional(['message' => 'attendance created successfully'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        // Return the attendance record as a JSON response
       return new AttendanceResource($attendance); 
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
            'child_id' => 'sometimes|exists:children,id',
            'date' => 'sometimes|date',
            'status' => 'sometimes|in:present,absent',
            'created_by' => 'sometimes|exists:users,id',
        ]);

        // Find the attendance record
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        // Update the attendance record
        $attendance->update($data);

        // Return a response
      return (new AttendanceResource($attendance))
            ->additional(['message' => 'attendance updated successfully']);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the attendance record
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        // Delete the attendance record
        $attendance->delete();

        // Return a response
        return response()->json(['message' => 'Attendance record deleted successfully'], 200);
    }
}
