<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Child;
use App\Http\controllers\API\ChildrenController;

class ChildResource extends JsonResource
{
public static $wrap = 'child'; // Wrap the resource in a 'child' key
      

    public function toArray(Request $request): array
    {
   return [
            'id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,]  ;  }
}
