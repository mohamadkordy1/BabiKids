<?php

namespace App\Repositories;

use App\Models\Child;
class ChildRepository
{
    
    public function all()
    {
        return Child::all();
    }

    public function find($id)
    {
        $child = Child::find($id);
         if (!$child) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Child::create($data);
    }

    public function update($id, array $data)
    {
        $child = Child::findOrFail($id);
        $child->update($data);
        return $child;
    }

    public function delete($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();
        return true;
    }
}
