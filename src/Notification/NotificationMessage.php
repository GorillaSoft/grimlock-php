<?php

namespace Grimlock\Notification;

/**
 * Class NotificationMessage
 * @package Grimlock\Notification
 * @author Rubén Darío Huamaní Ucharima
 */
class NotificationMessage
{

    private $title;
    private $message;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

}