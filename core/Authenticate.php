<?php

namespace Core;

use App\Model\Usuario;

trait Authenticate
{
    public function login()
    {
        $this->setPageTitle("Acesso");
        $this->setView("usuario/login", "layout/basic");
    }

    public function auth($request)
    {
        $result = Usuario::where('email', $request->post->email)->first();

        if ($result)
        {
            if (password_verify($request->post->password, $result->password))
            {
                $user = [
                    "id" => $result->id,
                    "email" => $result->email,
                    "name" => $result->name,
                    "type" => $result->type,
                    "grupo_id" => $result->grupo_id
                ];

                Session::set('user', $user);

                return Redirect::route(BASE_URL . "/");
            }
            else
            {
                return Redirect::route(BASE_URL . "/login", [
                    "error" => ["password" => "Senha Inválida!"],
                    "inputs" => ["email" => $request->post->email]
                ]);
            }
        }
        else
        {
            return Redirect::route(BASE_URL . "/login", [
                "error" => ["email" => "E-mail Inválido!"],
                "inputs" => ["email" => $request->post->email]
            ]);
        }
    }

    public function logout()
    {
        Session::destroy('user');
        return Redirect::route(BASE_URL . '/login');
    }
}