<?php

namespace Core;

use App\Model\Usuario;

trait Authenticate
{
    public function login()
    {
        $this->setPageTitle("Entrar");
        $this->setView("usuario/login", "layout/basic");
    }

    public function auth($request)
    {
        $result = Usuario::where('email', $request->post->email)->first();

        if ($result){

            if (password_verify($request->post->password, $result->password)) {
                $user = [
                    "id" => $result->id,
                    "email" => $result->email,
                    "name" => $result->name
                ];

                Session::set('user', $user);

                return Redirect::route("/");
            }
            else {
                return Redirect::route("/login", [
                    "error" => ["password" => "Senha Inválida!"],
                    "inputs" => ["email" => $request->post->email]
                ]);
            }
        }
        else {
            return Redirect::route("/login", [
                "error" => ["email" => "E-mail Inválido!"],
                "inputs" => ["email" => $request->post->email]
            ]);
        }
    }

    public function logout(){
        Session::destroy('user');
        Redirect::route('/login');
    }
}