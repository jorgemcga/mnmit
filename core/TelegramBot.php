<?php
/**
 * Description of TelegramBot
 *
 * @author jorge m abdalla
 */

namespace Core;

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

    public function groupId()
    {
        return $this->groupId;
    }

    public function msg()
    {
        return $this->msg;
    }

    public function send()
    {
        $post = [ 'chat_id' => $this->groupId, 'text' => $this->msg ];

        $ch = curl_init("https://api.telegram.org/bot{$this->APItoken}/sendMessage");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        die(var_dump($response) . "<br> <br>" . $error);

        //shell_exec("curl -X POST 'https://api.telegram.org/bot{$this->APItoken}/sendMessage' -d 'chat_id={$this->groupId}&text={$this->msg}'");
    }
}