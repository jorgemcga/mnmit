<?php
namespace Core;
/**
 * Description of TelegramBot
 *
 * @author jorge
 */
class TelegramBot
{
    private static $groupId;
    private static $msg;
    private static $APItoken;

    public function __construct()
    {
        return self::$this;
    }

    public static function setGroupId($groupId)
    {
        self::$groupId = $groupId;
        return self::$this;
    }

    public static function setMsg($msg)
    {
        self::$msg = $msg;
        return self::$this;
    }

    public static function addMsg($msg)
    {
        self::$msg .= "\n" . $msg;
        return self::$this;
    }

    public static function setAPItoken($token)
    {
        self::$APItoken = $token;
        return self::$this;
    }

    public static function groupId()
    {
        return self::$groupId;
    }

    public static function msg()
    {
        return self::$msg;
    }

    public static function send()
    {
        $token = self::$APItoken;
        $groupId = self::$groupId;
        $msg = self::$msg;
        return shell_exec("curl -X POST 'https://api.telegram.org/bot{$token}/sendMessage' -d 'chat_id={$groupId}&text={$msg}");
    }
}
