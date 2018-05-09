<?php
namespace App\Model;
/**
 * Description of GrupoAtivoCategoria
 *
 * @author jorge
 */
use Core\ModeloEloquent;

class GrupoAtivoCategoria extends ModeloEloquent
{
    protected $table = "grupo_categoria_ativo";

    public $timestamps = false;

    public $fillable = [
        'grupo_id',
        'categoria_ativo_id'
    ];

    public function data($request){
        return [
            'grupo_id' => $request->grupo_id,
            'categoria_ativo_id' => $request->categoria_ativo_id
        ];
    }

    public function grupo()
    {
        return $this->belongsTo("App\Model\Grupo");
    }

    public function categoria_ativo()
    {
        return $this->belongsTo("App\Model\CategoriaAtivo");
    }
}
