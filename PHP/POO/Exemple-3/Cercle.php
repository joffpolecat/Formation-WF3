<?php 

require_once('Forme.php');

final class Cercle extends Forme
{
    private $rayon;
    const  PI = 3.14;

    public function __construct($posX, $posY, $rayon)
    {
        $this->rayon = $rayon;
        parent::__construct($posX, $posY);
    }

    public function aire()
    {
        return self::PI * pow($this->rayon, 2);
    }

    public function perimetre()
    {
        return 2 * self::PI * $this->rayon;
    }
}
