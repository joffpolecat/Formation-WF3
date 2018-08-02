<?php

namespace Observer;

class Messagerie extends Subject
{
    public function envoyerMessage($message)
    {
        echo "Message envoyé: " . $message . ".</br>";
        $this->notify();
    }
}