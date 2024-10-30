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
            'file' => 'required|file|max:50|mimes:csv',
            'alignment' => 'required',
            'mesq' => 'nullable|integer',
            'mdir' => 'nullable|integer',
            'msup' => 'nullable|integer',
            'minf' => 'nullable|integer',
        ];
        return $rules;
    }

    public function messages(){
        return[
            'file.required' => 'O arquivo é obrigatório.',
            'file.max' => "O arquivo enviado é maior que :max kB",
            'file.mimes' => 'Insira um arquivo CSV válido e com mais de 3 linhas.',
            'mesq.integer' => 'O número da margem precisa ser um valor inteiro.',
            'mdir.integer' => 'O número da margem precisa ser um valor inteiro.',
            'msup.integer' => 'O número da margem precisa ser um valor inteiro.',
            'minf.integer' => 'O número da margem precisa ser um valor inteiro.',
        ];
    }

}
