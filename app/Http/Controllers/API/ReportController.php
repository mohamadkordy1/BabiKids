<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\report; 
use App\Http\Resources\ReportResource;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
    public $reportRepository;
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    } 
    public function index()
    {
       return ReportResource::collection($this->reportRepository->all());
    }

    
    public function store(StoreReportRequest $request)
    {       
        $report = $this->reportRepository->create($request->validated());

        // Return a response
      return (new ReportResource($report))
            ->additional(['message' => 'Report created successfully'])
            ->response()
            ->setStatusCode(201);
    }


    public function show(string $id)
    {
        $report = $this->reportRepository->find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }
        $Report = report::find($id);
        return new ReportResource($Report);
    }

    public function update(UpdateReportRequest $request, string $id)
    {
      
        $report = $this->reportRepository->find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $updatedReport = $this->reportRepository->update($id, $request->validated());
        return (new ReportResource($updatedReport))
            ->additional(['message' => 'Report updated successfully'])
            ->response()
            ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = $this->reportRepository->find($id);
        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $this->reportRepository->delete($id);

        return response()->json(['message' => 'Report deleted successfully']);
    }
}
