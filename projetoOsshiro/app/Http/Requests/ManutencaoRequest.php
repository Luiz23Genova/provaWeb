<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManutencaoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
          'titulo' => 'required',
          'descricao' => 'required',
          'data' => 'required',
          'colaborador_id' => 'required|exists:colaboradors,id',
          'categoria_id' => 'required|exists:categoria,id'
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'Título é obrigatório',
            'descricao.required' => 'Descrição é obrigatória',
            'data.required' => 'Data é obrigatória',
            'categoria_id.required' => 'Categoria é obrigatória',
            'colaborador_id.required' => 'colaborador é obrigatório',
            'colaborador_id.exists' => 'colaborador não encontrado',
            'categoria_id.exists' => 'Categoria não encontrada',


        ];
    }
}
