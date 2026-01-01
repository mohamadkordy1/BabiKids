<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { return [        

        'id' => $this->id,
            'date' => $this->date,
            'status' => $this->status,
            'check_in_time' => $this->check_in_time,
            'check_out_time' => $this->check_out_time,
            'child_id' => $this->child_id,
            'classroom_id' => $this->classroom_id,
            ]  ; 
            
          
    }
}
