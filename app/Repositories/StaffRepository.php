<?php

namespace App\Repositories;
use App\Models\Staff;
class StaffRepository
{
  
    public function all()
    {
        return Staff::all();
    }

    public function find($id)
    {
        $staff = Staff::find($id);
         if (!$staff) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Staff::create($data);
    }

    public function update($id, array $data)
    {
        $staff = Staff::findOrFail($id);
        $staff->update($data);
        return $staff;
    }

    public function delete($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return true;
    }
}
