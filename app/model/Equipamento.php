<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 31/08/2017
 * Time: 09:44
 */

namespace App\Model;


use Core\Model;

class Equipamento extends Model
{
    protected $table = "equipamento";

    public $equipamento_id = "";
    public $nrpatrimonio = "";
    public $nome = "";
    public $categoria_equipamento_id = "";
    public $usuario_id = "";

    public function data($request){
        return [
            'nrpatrimonio' => $request->nrpatrimonio,
            'nome' => $request->nome,
            'datacompra' => $request->datacompra,
            'categoria_equipamento_id' => $request->categoria_equipamento_id,
            'usuario_id' => $request->usuario_id
        ];
    }

    public function rules(){
        return [

        ];
    }

}