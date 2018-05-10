<?php
namespace Core;
/**
 * Description of Server
 *
 * @author jorge
 */
class Server
{
    private static $name;
    private static $email;
    private static $plataform;
    private static $status;

    public function __construct()
    {
        $monitor = \App\Model\Monitoramento();
        $data = $monitor->first();
        self::$name = $data->nome;
        self::$email = $data->email;
        self::$plataform = $data->plataforma;
        self::$status = $data->status;
        return self::$this;
    }

    public static function name()
    {
        return self::$name;
    }

    public static function email()
    {
        return self::$email;
    }

    public static function plataform()
    {
        return self::$plataform;
    }

    public static function status()
    {
        return self::$status;
    }
}
