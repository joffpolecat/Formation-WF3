<?php 

namespace Observer;

class Notification implements \SplObserver
{
    public function update(\SplSubject $SplSubject)
    {
        echo "Notification: Message envoyer<br/>";
    }
}