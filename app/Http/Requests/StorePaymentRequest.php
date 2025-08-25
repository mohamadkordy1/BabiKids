<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'amount' => 'sometimes|required|numeric|min:0',
            'parent_id' => 'sometimes|required|exists:users,id', // Assuming you have a Child model
            'payment_date' => 'sometimes|required|date',
            'payment_method' => 'sometimes|required|string|max:255', // Assuming payment method is a string
            'status' => 'sometimes|required|in:paid,pending,failed',
        ];
    }
}
