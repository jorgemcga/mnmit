<?php
/**
 * Description of Email
 *
 * @author jorge
 */

namespace Core;

use \SendGrid;
use \SendGrid\Mail\Mail;

class Email
{
    private $sendGridMail = null;
    private $sendgrid = null;

    public function __construct()
    {
        $this->sendGridMail = new Mail();
        $this->sendgrid = new SendGrid(SENDGRID_API_KEY);
        return $this;
    }

    public function setSender($name, $email)
    {
        $this->sendGridMail->setFrom($email, $name);
        return $this;
    }

    public function addRecipients($recipients)
    {
        if (!is_array($recipients))
        {
            $this->sendGridMail->addTo($recipients);
            return $this;
        }

        foreach($recipients as $recipient)
        {
            $this->sendGridMail->addTo($recipient);
        }
        return $this;
    }

    public function addCc($email, $name)
    {
        $this->sendGridMail->addBcc($email);
        return $this;
    }

    public function addCcs($ccs)
    {
        foreach($ccs as $cc)
        {
            $this->sendGridMail->addBcc($cc['email']);
        }
        return $this;
    }

    public function addMessage($message)
    {
        //"text/plain" <- can use
        $this->sendGridMail->addContent("text/html", $message);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->sendGridMail->setSubject($subject);
        return $this;
    }

    public function send()
    {
        try
        {
            $response = $this->sendgrid->send($this->sendGridMail);
//            echo $response->statusCode() . "\n";
//            print_r($response->headers());
//            echo $response->body() . "\n";
        }
        catch (Exception $e)
        {
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return true;
        //Send Email
        //return mail($this->recipient, $this->subject, $this->message, $this->headers);
    }
}