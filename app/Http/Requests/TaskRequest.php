<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'nullable'],
            'deadline' => ['date', 'required'],
            'priority' => ['required', Rule::in(values: ['low', 'medium', 'high'])],
            'status' => ['required', Rule::in(values: ['toDo', 'inProgress', 'done'])],
        ];
    }
}
