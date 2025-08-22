<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskStoreRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'details' => 'nullable|string',
            'priority' => ['required', 'in:low,medium,high'],
            'is_completed' => 'required|boolean',
            'assignee_ids' => 'sometimes|array',
            'assignee_ids.*' => 'integer|exists:users,id',
        ];
    }
    
    public function messages(): array
    {
        return [
            'project_id.required' => 'Project ID is required.',
            'project_id.exists' => 'Project ID must be a valid project.',
            'title.required' => 'Task title is required.',
            'title.string' => 'Task title must be a string.',
            'title.max' => 'Task title may not be greater than 255 characters.',
            'details.string' => 'Task details must be a string.',
            'priority.required' => 'Task priority is required.',
            'priority.in' => 'Task priority must be one of the following: low, medium, high.',
            'is_completed.required' => 'Task completion status is required.',
            'is_completed.boolean' => 'Task completion status must be true or false.',
            'assignee_ids.array' => 'Assignee IDs must be an array.',
            'assignee_ids.*.integer' => 'Each assignee ID must be an integer.',
            'assignee_ids.*.exists' => 'Each assignee ID must be a valid user.',
        ];
    }


    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'message' => 'Validation Failed'
        ], 422));
    }
}
