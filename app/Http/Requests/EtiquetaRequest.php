<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtiquetaRequest extends FormRequest
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
        $rules = [
            'file' => 'required',
        ];
        return $rules;
    }

    public function messages(){
        return[
            'file.required' => 'O arquivo é obrigatório',
        ];
    }

}
