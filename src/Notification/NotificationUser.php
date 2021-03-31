<?php

namespace Grimlock\Notification;

/**
 * Class NotificationUser
 * @package Grimlock\Notification
 * @author Rubén Darío Huamaní Ucharima
 */
class NotificationUser
{

    private $idRegistration;

    /**
     * @return mixed
     */
    public function getIdRegistration()
    {
        return $this->idRegistration;
    }

    /**
     * @param mixed $idRegistration
     */
    public function setIdRegistration($idRegistration): void
    {
        $this->idRegistration = $idRegistration;
    }

}