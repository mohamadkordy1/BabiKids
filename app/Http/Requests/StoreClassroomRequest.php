<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ✅ Allow all authenticated users for now
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'teacher_id' => 'required|exists:users,id',
            'activities_id' => 'nullable|exists:activities,id',
        ];
    }
}
