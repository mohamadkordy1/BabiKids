<?php

namespace App\Repositories;
use App\Models\Activity;
class ActivityRepository
{
    public function all()
    {
        return Activity::all();
    }

    public function find($id)
    {
        $activity = Activity::find($id);
         if (!$activity) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return Activity::create($data);
    }

    public function update($id, array $data)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($data);
        return $activity;
    }

    public function delete($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return true;
    }
}
