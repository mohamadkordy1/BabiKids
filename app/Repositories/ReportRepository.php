<?php

namespace App\Repositories;
use App\Models\Report;
class ReportRepository
{
    public function all()
    {
        return Report::all();
    }

    public function find($id)
    {
        $report = Report::find($id);
         if (!$report) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Report::create($data);
    }

    public function update($id, array $data)
    {
        $report = Report::findOrFail($id);
        $report->update($data);
        return $report;
    }

    public function delete($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return true;
    }
   
}
