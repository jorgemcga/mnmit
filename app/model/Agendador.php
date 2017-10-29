<?php

namespace App\Model;

use Core\ModeloEloquent;

class Agendador extends ModeloEloquent
{

    protected $table = "agendador";

    public $fillable = [
        'periodicidade',
        'tipo',
    ];

    public function data($request){
        return [
            'periodicidade' => $request->periodicidade,
        ];
    }

    public function rules(){
        return [

        ];
    }

    public function validarHora()
    {
        return (time() >= strtotime($this->updated_at)) ? true : false;
    }

    public function validarHorario()
    {
        $datetime1 = new \DateTime(date("Y-m-d H:i:s"));
        $datetime2 = new \DateTime($this->updated_at);

        $diff = $datetime1->diff($datetime2)->format("%H:%I:%S");

        return (strtotime($diff) >= strtotime('01:00:00')) ? true : false;
    }

    public function validarDiario()
    {
        $datetime1 = new \DateTime(date("Y-m-d H:i:s"));
        $datetime2 = new \DateTime($this->updated_at);

        $diff = $datetime1->diff($datetime2)->format("%D");

        if($diff >= 1){
            $this->validarHorario()? true : false;
        }
        else return false;
    }

    public function validarSemanal()
    {
        $datetime1 = new \DateTime(date("Y-m-d H:i:s"));
        $datetime2 = new \DateTime($this->updated_at);

        $diff = $datetime1->diff($datetime2)->format("%D");

        if ($diff >= 7){
            $this->validarHorario()? true : false;
        }
        else return false;
    }

    public function validarMensal()
    {
        $datetime1 = new \DateTime(date("Y-m-d H:i:s"));
        $datetime2 = new \DateTime($this->updated_at);

        $diff = $datetime1->diff($datetime2)->format("%D");

        if ($diff >= 30){
            $this->validarHorario()? true : false;
        }
        else return false;
    }

}