<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
               'child_id' => 'required|exists:children,id', // Assuming you have a Child model
               'classroom_id' => 'required|exists:classrooms,id', // Assuming you have a Child model
            'date' => 'required|date',
            'status' => 'required|in:present,absent', // Assuming status can be present or absent
            'created_by' => 'sometimes|exists:users,id',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
        ];
    }
}
