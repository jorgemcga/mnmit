<?php
namespace Core;
/**
 * Description of TelegramBot
 *
 * @author jorge
 */
class TelegramBot
{
    private $groupId;
    private $msg;
    private $APItoken;

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function addMsg($msg)
    {
        $this->msg .= "\n" . $msg;
        return $this;
    }

    public function setAPItoken($token)
    {
        $this->APItoken = $token;
        return $this;
    }

    public static function groupId()
    {
        return $this->groupId;
    }

    public static function msg()
    {
        return $this->msg;
    }

    public function send()
    {
        return shell_exec("curl -X POST 'https://api.telegram.org/bot{$this->APItoken}/sendMessage' -d 'chat_id={$this->groupId}&text={$this->msg}'");
    }
}