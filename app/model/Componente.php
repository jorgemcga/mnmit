<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 27/08/2017
 * Time: 15:54
 */

namespace App\Model;


use Core\Model;

class Componente extends Model
{
    protected $table = "componente";

    public $componente_id = "";
    public $nome = "";
    public $valor = "";
    public $categoria_componente_id = "";
    public $ativo_id = "";

    public function data($request){
        return [
            'nome' => $request->nome,
            'valor' => $request->valor,
            'categoria_componente_id' => $request->categoria_componente_id,
            'ativo_id' => $request->ativo_id
        ];
    }

    public function rules(){
        return [

        ];
    }

}