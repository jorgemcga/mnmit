<?php
namespace Core;
/**
 * Description of Email
 *
 * @author jorge
 */
class Email
{
    private static $sender = ["name" => "", "email" => ""];
    private static $recipient = "";
    private static $message = "";
    private static $subject = "";
    private static $headers = "";

    public static function setSender($name, $email)
    {
        self::$recipient["name"] = $name;
        self::$recipient["email"] = $email;
        return self;
    }

    public static function setRecipient($recipient)
    {
        self::$recipient = $recipient;
        return self;
    }

    public static function addRecipients($recipients)
    {
        foreach($recipients as $recipient)
        {
            self::$recipient .= ",{$recipient}";
        }
        return self;
    }

    public static function addCc($email, $name)
    {
        self::$headers .= "Cc: {$name} <{$email}>\n";
        return self;
    }

    public static function setMessage($message)
    {
        self::$message = $message . "<br>";
        return self;
    }

    public static function addMessage($message)
    {
        self::$message .= $message . "<br>";
        return self;
    }

    public static function setSubject($subject)
    {
        self::$subject = $subject;
        return self;
    }

    public static function setHeader()
    {
        self::$headers .=  "Content-Type:text/html; charset=iso-8859-1 \n";
        self::$headers .= "From: " . self::$sender["name"] .  "<" . self::$sender["email"] . ">\n";
        self::$headers .= "X-Mailer: PHP  v".phpversion()."\n";
        self::$headers .= "Return-Path: " . self::$sender["email"] . "\n";
        self::$headers .= "MIME-Version: 1.0\n";
        return self;
    }

    public static function send()
    {
        self::setHeader();
        //Send Email
        return mail(self::$recipient, self::$subject, self::$message, self::$headers);
    }
}
