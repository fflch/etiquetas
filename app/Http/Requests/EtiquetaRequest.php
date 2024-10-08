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
            'file' => 'required|file|max:20000|mimes:csv'
        ];
        return $rules;
    }

    public function messages(){
        return[
            'file.required' => 'O arquivo é obrigatório',
            'file.file' => 'Insira um arquivo',
            'file.max' => 'O arquivo enviado é muito pesado',
            'file.mimes' => 'Envie um arquivo CSV.'
        ];
    }

}
