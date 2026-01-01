<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgressRequest extends FormRequest
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
         
            'classroom_id' => 'required|exists:classrooms,id', // Assuming you have a Classroom model
            'goal_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'status' => 'required|in:in-progress,completed,', //
            'notes' => 'nullable|string'
        ];
    }
}
