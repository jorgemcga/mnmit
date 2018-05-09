<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/09/2017
 * Time: 16:12
 */

namespace App\Model;


use Core\ModeloEloquent;

class Grupo extends ModeloEloquent
{
    public $table = "grupo";

    public $fillable = ['nome', 'email', 'telegram_group'];

    public function data($request){
        return [
            'nome' => $request->nome,
            'email' => $request->email,
            'telegram_group' => $request->telegram_group
        ];
    }
}