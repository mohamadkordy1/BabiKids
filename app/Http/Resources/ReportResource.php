<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
                    'report_date' => $this->report_date,
                    'report_type' => $this->report_type,
                    'content' => $this->content,
                    'created_by' => $this->created_by,
                    ]  ;
    }
}
