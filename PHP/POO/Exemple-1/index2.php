<?php 

class Math
{
    const PI = 3.14;
    public static function sqrt ($value)
    {
        return sqrt($value);
    }
}

echo Math::sqrt(64);
echo '</br>';
echo Math::PI;