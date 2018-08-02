<?php 

class Math 
{
    const PI = 3.14;
    public static function sqrt($value) 
    {
        return sqrt($value);
    }
}
/*
$objMath = new Math;
echo $objMath->sqrt(64);
*/
echo Math::sqrt(64);
echo '<br/>';
echo Math::PI;