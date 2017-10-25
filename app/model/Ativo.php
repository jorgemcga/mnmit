<?php

namespace App\Model;

use Core\ModeloEloquent;

class Ativo extends ModeloEloquent
{
    protected $table = "ativo";

    public $fillable = [
        'nrpatrimonio',
        'nome',
        'tag',
        'descricao',
        'datacompra',
        'categoria_ativo_id',
        'so_id',
        'modelo_id',
        'serial',
        'usuario_id'
    ];

    public function data($request){

        return $data = [
            'nrpatrimonio' => $request->nrpatrimonio,
            'nome' => $request->nome,
            'tag' => $request->tag,
            'descricao' => $request->descricao,
            'datacompra' => $request->datacompra,
            'categoria_ativo_id' => $request->categoria_ativo_id,
            'so_id' => $request->so_id,
            'modelo_id'=> $request->modelo_id,
            'serial' => $request->serial,
            'usuario_id' => $request->usuario_id
        ];
    }

    public function rules(){
        return [
            'nome' => 'requerid|min:4',
            'categoria_ativo_id' => 'requerid'
        ];
    }

    public function categoria_ativo()
    {
        return $this->belongsTo('\App\Model\CategoriaAtivo');
    }

    public function modelo()
    {
        return $this->belongsTo('\App\Model\Modelo');
    }

    public function so()
    {
        return $this->belongsTo('\App\Model\SistemaOperacional');
    }

    public function usuario()
    {
        return $this->belongsTo('\App\Model\Usuario');
    }

    public function interface_rede(){
        return $this->hasMany('\App\Model\InterfaceRede');
    }

}