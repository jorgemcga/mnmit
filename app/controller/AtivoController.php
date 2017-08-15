<?php

namespace App\Controller;

class AtivoController
{
    public function index(){
        echo "index Ativos";
    }

    public function editar($id, $request){
        echo "Editando ativo id: " . $id . " Com os dados: " . $request->get->nome . " e " . $request->get->obs;

    }

}