<?php
namespace Core;
/**
 * Description of Email
 *
 * @author jorge
 */
class Email
{
    private $sender = ["name" => "", "email" => ""];
    private $recipient = "";
    private $message = "";
    private $subject = "";
    private $headers = "";

    public function setSender($name, $email)
    {
        $this->recipient["name"] = $name;
        $this->recipient["email"] = $email;
        return $this;
    }

    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function addRecipients($recipients)
    {
        if (is_array($recipients))
        {
            foreach($recipients as $recipient)
            {
                $this->recipient .= ",{$recipient}";
            }
        }
        else
        {
            $this->recipient .= ",{$recipients}";
        }
        return $this;
    }
    
    public function addCc($email, $name)
    {
        $this->headers .= "Cc: {$name} <{$email}>\n";
        return $this;
    }


    public function addCcs($ccs)
    {
        foreach($ccs as $cc)
        {
            $this->headers .= "Cc: {$cc['name']} <{$cc['email']}>\n";
        }
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message . "<br>";
        return $this;
    }

    public function addMessage($message)
    {
        $this->message .= $message . "<br>";
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setHeader()
    {
        $this->headers .=  "Content-Type:text/html; charset=iso-8859-1 \n";
        $this->headers .= "From: " . $this->sender["name"] .  "<" . $this->sender["email"] . ">\n";
        $this->headers .= "X-Mailer: PHP  v".phpversion()."\n";
        $this->headers .= "Return-Path: " . $this->sender["email"] . "\n";
        $this->headers .= "MIME-Version: 1.0\n";
        return $this;
    }

    public function send()
    {
        $this->setHeader();
        //Send Email
        return mail($this->recipient, $this->subject, $this->message, $this->headers);
    }
}
