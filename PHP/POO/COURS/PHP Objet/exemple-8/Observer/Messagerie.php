<?php 

namespace Observer;

class Messagerie extends Subject 
{
    public function envoyerMessage($message)
    {
        echo "Message envoyer: $message<br/>";
        $this->notify();
    }
}