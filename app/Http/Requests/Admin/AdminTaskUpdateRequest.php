<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminTaskUpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string', 'max:510'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'int'],
            'categories' => ['required', 'array', 'min:1'],
            'users' => ['required', 'array', 'min:1'],
            'subtasks' => ['nullable', 'array'],
            'subtasks.*' => ['nullable', 'string', 'max:255'],
            'new_subtasks' => ['nullable', 'array'],
            'new_subtasks.*' => ['nullable', 'string', 'max:255']
        ];
    }
}
