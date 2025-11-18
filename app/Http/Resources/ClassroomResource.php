<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'start_time'   => $this->start_time,
            'end_time'     => $this->end_time,
            'teacher'      => $this->teacher ? $this->teacher->name : null,
            'activity'     => $this->activity ? $this->activity->title : null,
            'children'     => $this->children->pluck('name'),
            'created_at'   => $this->created_at,
        ];
    }
}
