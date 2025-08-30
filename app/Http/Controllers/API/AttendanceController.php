<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance; // Assuming you have an Attendance model
use App\Http\Resources\AttendanceResource;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Repositories\AttendanceRepository;

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
    public function store(StoreAttendanceRequest $request)
    {
        // Create a new attendance record
        $attendance = Attendance::create($request->validated());

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
    public function update(UpdateAttendanceRequest $request, string $id)
    {

        // Find the attendance record
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        // Update the attendance record
        $attendance->update($request->validated());

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
