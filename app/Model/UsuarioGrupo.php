<?php
namespace App\Model;
/**
 * Description of UsuarioGrupo
 *
 * @author jorge
 */

use Core\ModeloEloquent;

class UsuarioGrupo extends ModeloEloquent
{
    protected $table = "usuario_grupo";

    public $timestamps = false;

    public $fillable = [
        'usuario_id',
        'grupo_id',
    ];

    public function data($request){
        return [
            'usuario_id' => $request->usuario_id,
            'grupo_id' => $request->grupo_id,
        ];
    }

    public function usuario()
    {
        return $this->belongsTo("App\Model\Usuario");
    }

    public function grupo()
    {
        return $this->belongsTo("App\Model\Grupo");
    }
}
