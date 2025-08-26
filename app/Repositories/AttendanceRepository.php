<?php

namespace App\Repositories;
use App\Models\Attendance;
class AttendanceRepository
{
    public function all()
    {
        return Attendance::all();
    }

    public function find($id)
    {
        $attendance = Attendance::find($id);
         if (!$attendance) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function update($id, array $data)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($data);
        return $attendance;
    }

    public function delete($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return true;
    }
   
}
