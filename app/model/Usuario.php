<?php

namespace App\Model;


use Core\ModeloEloquent;

class Usuario extends ModeloEloquent
{
    public $table = "usuario";

    public $fillable = ['name', 'email', 'password', 'type'];

    public function data($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => $request->type,
            'oldpassword' => $request->oldpassword,
            'password1' => $request->password1,
            'password2' => $request->password2,
        ];
    }

    public function rulesCreate(){
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:Usuario:email',
            'password' => 'min:6'
        ];
    }

    public function rulesUpdate($id){
        return [
            'name' => 'min:4|max:255',
            'email' => 'email|unique:Usuario:email:$id',
            'password' => 'min:6'
        ];
    }

    public function grupo(){
        return $this->belongsTo('\App\Model\Grupo');
    }

}