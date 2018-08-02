<?php 

abstract class Forme 
{
    protected $posX;
    protected $posY;

    public function __construct($posX, $posY)
    {
        $this->setPosX($posX);
        $this->setPosY($posY);
    }

    public function getPosX()
    {
        return $this->posX;
    }
 
    public function setPosX($posX)
    {
        $this->posX = $posX;

        return $this;
    }

    public function getPosY()
    {
        return $this->posY;
    }

    public function setPosY($posY)
    {
        $this->posY = $posY;

        return $this;
    }

    public abstract function aire();
    public abstract function perimetre();
}