<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Imoveis extends Model
{
    
    protected $table = 'imovel';
    protected $fillable = [
        'tipo_id',
        'negocio_id',
        'anunciante',
        'email',
        'pais',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'complemento',
        'cep',
        'telefone'
    ];

    protected function regras()
    { //regras de validação
        return [
            'tipo_id'            => ['required', 'numeric', 'max:2', 'min:1'],
            'negocio_id'         => ['required', 'numeric', 'max:2', 'min: 1'],
            'anunciante'         => ['required', 'string', 'min:5', 'max:40'],
            'email'              => ['required', 'string', 'min:5', 'max:40', 'email'],
            'pais'               => ['required', 'string', 'min:3', 'max:20'],
            'estado'             => ['required', 'string', 'min:2', 'max:20'],
            'cidade'             => ['required', 'string', 'min:3', 'max:20'],
            'bairro'             => ['required', 'string', 'min:3', 'max:20'],
            'rua'                => ['required', 'string', 'min:3', 'max:30'],
            'complemento'        => ['required', 'int', 'min:1'],
            'cep'                => ['required', 'string', 'min:9', 'max:10'],
            'telefone'           => ['required', 'numeric'],
        ];
    }

    protected function mensagens() //mensagens para erros
    {
        return [
            'tipo_id.required' => "O campo tipo é obrigatório",
            'tipo_id.max' => "O campo tipo deve ter no máximo 2 caracteres",
            'tipo_id.min' => "O campo tipo deve ter no mínimo 1 caracteres",
            'tipo_id.numeric' => "O campo tipo deve ser 0 ou 1 ('casa' ou 'apartamento')",
            
            'negocio_id.required' => "O campo negocio é obrigatório",
            'negocio_id.max' => "O campo negocio deve ter no máximo 2 caracteres",
            'negocio_id.min' => "O campo negocio deve ter no mínimo 1 caracteres",
            'negocio_id.numeric' => "O campo negocio deve ser 0 ou 1 ('venda' ou 'aluguel')",

            'anunciante.required' => "O campo anunciante é obrigatório",
            'anunciante.max' => "O campo anunciante deve ter no máximo 40 caracteres",
            'anunciante.min' => "O campo anunciante deve ter no mínimo 5 caracteres",
            'anunciante.string' => "O campo anunciante não deve conter números",

            'email.email' => "O campo e-mail precisa conter um e-mail válido",
            'email.max' => "O campo email deve ter no máximo 30 caracteres",
            'email.min' => "O campo email deve ter no mínimo 5 caracteres",
            'email.string' => "O campo email não deve conter números",

            'pais.required' => "O campo país é obrigatório",
            'pais.max' => "O campo país deve ter no máximo 20 caracteres",
            'pais.min' => "O campo país deve ter no mínimo 3 caracteres",
            'pais.string' => "O campo pais não deve conter números",

            'estado.required' => "O campo estado é obrigatório",
            'estado.max' => "O campo estado deve ter no máximo 20 caracteres",
            'estado.min' => "O campo estado deve ter no mínimo 3 caracteres",
            'estado.string' => "O campo estado não deve conter números",

            'cidade.required' => "O campo cidade é obrigatório",
            'cidade.max' => "O campo cidade deve ter no máximo 20 caracteres",
            'cidade.min' => "O campo cidade deve ter no mínimo 3 caracteres",
            'cidade.string' => "O campo cidade não deve conter números",

            'bairro.required' => "O campo bairro é obrigatório",
            'bairro.max' => "O campo bairro deve ter no máximo 20 caracteres",
            'bairro.min' => "O campo bairro deve ter no mínimo 3 caracteres",
            'bairro.string' => "O campo bairro não deve conter números",

            'rua.required' => "O campo rua é obrigatório",
            'rua.max' => "O campo rua deve ter no máximo 30 caracteres",
            'rua.min' => "O campo rua deve ter no mínimo 3 caracteres",
            'rua.string' => "O campo rua não deve conter números",

            'complemento.required' => "O campo complemento é obrigatório",
            'complemento.max' => "O campo complemento deve ter no máximo 5 caracteres",
            'complemento.min' => "O campo complemento deve ter no mínimo 1 caracteres",
            'complemento.numeric' => "O campo complemento deve conter apenas números",

            'cep.required' => "O campo cep é obrigatório",
            'cep.max' => "O campo cep deve ter no máximo 9 caracteres",
            'cep.min' => "O campo cep deve ter no mínimo 10 caracteres",

            'telefone.required' => "O campo telefone é obrigatório",
            'telefone.min' => "O campo telefone deve ter no mínimo 11 dígitos",
            'telefone.max' => "O campo telefone deve ter no máximo 12 dígitos",
        ];
    }

    public function validacao(Request $request)
    {
        $validator = Validator::make($request->all(), $this->regras(), $this->mensagens());

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return [];
        }
    }

}
