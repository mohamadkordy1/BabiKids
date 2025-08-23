<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
                'amount' => $this->amount,
                'payment_date' => $this->payment_date,
                'payment_method' => $this->payment_method,
                'status' => $this->status,
                'parent_id' => $this->parent_id,
                ]  ;
    }
}
