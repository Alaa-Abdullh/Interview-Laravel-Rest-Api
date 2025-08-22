<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class TaskUpdateRequest extends FormRequest
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
            'project_id' => 'sometimes|exists:projects,id',
            'title' => 'sometimes|string|max:255',
            'details' => 'sometimes|nullable|string',
            'priority' => ['sometimes', 'in:low,medium,high'],
            'is_completed' => 'sometimes|boolean',
            'assignee_ids' => 'sometimes|array',
            'assignee_ids.*' => 'integer|exists:users,id',
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
