<?php

namespace App\Model;

use Core\ModeloEloquent;

class Modelo extends ModeloEloquent
{
    protected $table = "modelo";

    public $fillable = ['nome', 'fabricante_id'];
    public $timestamps = false;

    public function data($request)
    {
        return [
            'nome' => $request->nome,
            'fabricante_id' => $request->fabricante_id
        ];
    }

    public function rules()
    {
        return [];
    }

    public function fabricante(){
        return $this->belongsTo('\App\Model\Fabricante');
    }

}