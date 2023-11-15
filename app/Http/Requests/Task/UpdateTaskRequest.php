<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',     // il titolo non deve essere per forza presente ma nel caso dovrà essere obbligatoriamete una stringa di massimo 225 caratteri
            'completed' => 'sometimes|required|boolean',     // il campo non deve essere per forza presente ma nel caso dovrà essere booleano e non potrà essere null
            'project_id' => 'nullable|exists:projects,id'
        ];
    }
}
