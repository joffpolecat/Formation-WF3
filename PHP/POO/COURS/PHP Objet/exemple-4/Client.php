<?php

require_once('Supprimable.php');

class Client implements Supprimable
{
    public function supprimer()
    {
        echo "Suppression du client";
    }
}