<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\report; 
use App\Http\Resources\ReportResource;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        // This method should return a list of reports
        // Assuming you have a Report model
        $reports = report::all();

        // Return the reports as a JSON response
                       return ReportResource::collection($reports);

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
            'report_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string',
            'created_by' => 'required|exists:users,id', // Assuming you have a User model
        ]);

        // Create a new report
        $report = report::create($data);

        // Return a response
    return (new ReportResource($report))
            ->additional(['message' => 'report created successfully'])
            ->response()
            ->setStatusCode(201);  }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        // Return the report as a JSON response
          return new ReportResource($report);
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
            'report_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string',
            'created_by' => 'required|exists:users,id', // Assuming you have a User model
        ]);

        // Find the report record
        $report = report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        // Update the report record
        $report->update($data);

        // Return a response
        
         return (new ReportResource($report))
            ->additional(['message' => 'report updated successfully']); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the report record
        $report = report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        // Delete the report record
        $report->delete();

        // Return a response
        return response()->json(['message' => 'Report deleted successfully'], 200);
    }
}
