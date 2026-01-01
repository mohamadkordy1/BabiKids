<?php

namespace App\Repositories;

use App\Models\Classroom;

class ClassroomRepository
{
    public function all()
    {
        return Classroom::with(['teacher', 'activity', 'children'])->get();
    }

    public function find($id)
    {
        return Classroom::with(['teacher', 'activity', 'children'])->find($id);
    }

    public function create(array $data)
    {
        return Classroom::create($data);
    }

    public function update($id, array $data)
    {
        $classroom = Classroom::find($id);
        if ($classroom) {
            $classroom->update($data);
        }
        return $classroom;
    }

    public function delete($id)
    {
        $classroom = Classroom::find($id);
        if ($classroom) {
            $classroom->delete();
        }
        return true;
    }
}
