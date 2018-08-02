<?php 

namespace Traits;

trait ValidationTrait 
{
    private function isMail(string $email)
    {
        return (filter_var(strtolower($email), FILTER_VALIDATE_EMAIL));
    }

    private function isStringLength(string $string, $min, $max)
    {
        return strlen($string) > $min && strlen($string) < $max;
    }
}