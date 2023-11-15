<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',    // il titolo è richiesto come una stringa di massimo 255 caratteri
            'project_id' => [       // questo fa in modo che l'id non può essere inserito con un id di un project non creato dall'utente loggato
                'nullable',
                Rule::exists('projects', 'id')->where(function ($query) {
                    $query->where('creator_id', Auth::id());
                })
            ],
        ];
    }
}
