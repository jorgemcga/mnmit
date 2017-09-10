<?php

namespace Core;

class Redirect
{
    public static function route($url, $msgs = []){

        if (count($msgs) > 0){
            foreach ($msgs as $key => $value) {
                Session::set($key, $value);
            }
        }

        return header("location:{$url}");

    }

}