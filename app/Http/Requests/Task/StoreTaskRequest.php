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
            'project_id' => [       // questo fa in modo che l'id può essere inserito sia dal creatore che dai membri
                'nullable',
                Rule::in(Auth::user()->memberships->pluck('id'))
            ],
        ];
    }
}
