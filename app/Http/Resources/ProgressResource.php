<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {       
    return [        
                    'id' => $this->id,
                    'child_id' => $this->child_id,
                    'goal_title' => $this->goal_title,
                    'start_date' => $this->start_date,
                    'target_date' => $this->target_date,
                    'status' => $this->status,
                    'notes' => $this->notes,
                    ]  ;
       
    }
}
