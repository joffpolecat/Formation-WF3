<?php 

require_once('Produit.php');

final class Livre extends Produit
{
    private $isbn;

    public function __construct($prix, $poids, $isbn)
    {
        $this->setIsbn($isbn);
        parent::__construct($prix, $poids);
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }
}