<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            'report_date' => 'required|date',
            'report_type' => 'required|string|max:255',
            'content' => 'required|string',
            'created_by' => 'required|exists:users,id',
        ];
    }
}
