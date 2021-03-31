<?php

namespace Grimlock;

use Grimlock\Enum\EnumNotificationProvider;
use Grimlock\Exception\GrimlockException;
use Grimlock\Notification\NotificationMessage;
use Grimlock\Notification\NotificationUser;
use Grimlock\Util\ArrayList;

class NotificationPush
{
    private $provider;
    private $key;
    private $curl_session;
    private $curl_headers;

    public function __construct($provider = EnumNotificationProvider::FIREBASE, $key = "")
    {
        $this->provider = $provider;
        $this->key = $key;
        switch($provider) {
            case EnumNotificationProvider::FIREBASE:
                $this->prepareFirebase();
                break;
            default:
                $this->prepareFirebase();

        }
    }

    private function prepareFirebase()
    {
        if (!empty($this>key)) {
            $this->curl_session = curl_init();
            $this->curl_headers = array('Authorization:key=' . $this->key, 'Content-Type:application/json', 'Content-Length: 0');

            curl_setopt($this->curl_session, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
            curl_setopt($this->curl_session, CURLOPT_POST, TRUE);
            curl_setopt($this->curl_session, CURLOPT_HTTPHEADER, $this->curl_headers);
            curl_setopt($this->curl_session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->curl_session, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl_session, CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE_v4);
        } else {
            throw new GrimlockException(NotificationPush::class, 'Key cannot be null or empty');
        }
    }

    public function send(NotificationMessage $notificationMessage, NotificationUser $user = null, ArrayList $users = null)
    {
        if ($user == null and $users == null)
        {
            throw new GrimlockException(NotificationPush::class, 'User or users, the two cannot be null or empty');
        }
        else
        {
            if ($user != null)
            {
                $fields = array('to' => $user->getIdRegistration(),
                    'notification' => array('title' => $notificationMessage->getTitle(), 'body' => $notificationMessage->getMessage()));
                $payload = json_encode($fields);
                curl_setopt($this->curl_session, CURLOPT_POSTFIELDS, $payload);

                curl_exec($this->curl_session);
            }
            else if ($users != null)
            {
                $tokens = array();
                for ($i = 0; $i < $users->getSize(); $i++)
                {
                    $tokens[$i] = $users->getItem($i)->getIdRegistration();
                }

                $idRegistrations = array_chunk($tokens, 1000);

                $fields = array('registration_ids' => $idRegistrations,
                    'notification' => array('title' => $notificationMessage->getTitle(), 'body' => $notificationMessage->getMessage()));
                $payload = json_encode($fields);
                curl_setopt($this->curl_session, CURLOPT_POSTFIELDS, $payload);

                curl_exec($this->curl_session);
            }

            curl_close($this->curl_session);
        }
    }

}