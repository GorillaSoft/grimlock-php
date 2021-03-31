<?php

namespace Grimlock\Mail;

class MailAttachment
{

    private $base64;
    private $name;
    private $type;

    /**
     * @return the $base64
     */
    public function getBase64()
    {
        return $this->base64;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param field_type $base64
     */
    public function setBase64($base64)
    {
        $this->base64 = $base64;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param field_type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}

