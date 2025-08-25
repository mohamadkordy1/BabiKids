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
          'child_id' => 'required|exists:children,id', // Assuming you have a Child model
            'goal_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'status' => 'required|in:ongoing,completed,7-7-2025', //
            'notes' => 'nullable|string'
        ];
    }
}
