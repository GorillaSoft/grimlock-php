<?php
namespace Grimlock\Mail;

class MailPerson
{

    private $mail;
    private $name;

    /**
     * @return the $mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param field_type $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

