<?php

namespace App\Repositories;
use App\Models\Progress;
class ProgressRepository
{
    public function all()
    {
        return Progress::all();
    }

    public function find($id)
    {
        $progress = Progress::find($id);
         if (!$progress) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Progress::create($data);
    }

    public function update($id, array $data)
    {
        $progress = Progress::findOrFail($id);
        $progress->update($data);
        return $progress;
    }

    public function delete($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();
        return true;
    }
    
}
