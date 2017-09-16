<?php

namespace App\Model;

use Core\Model;

class Ativo extends Model
{
    protected $table = "ativo";

    public $ativo_id = "";
    public $nrpatrimonio = "";
    public $nome = "";
    public $tag = "";
    public $descricao = "";
    public $datacompra = "";
    public $monitorar = "checked";
    public $categoria_ativo_id = "";
    public $so_id = "";
    public $serial = "";
    public $modelo_id = "";
    public $usuario_id = "";

    public function data($request){

        return $data = [
            'nrpatrimonio' => $request->nrpatrimonio,
            'nome' => $request->nome,
            'tag' => $request->tag,
            'descricao' => $request->descricao,
            'datacompra' => $request->datacompra,
            'monitorar' => $request->monitorar,
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

}