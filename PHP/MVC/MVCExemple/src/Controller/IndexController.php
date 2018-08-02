<?php 

namespace Controller;

class IndexController
{
    public function index($var = "World")
    {
        return array(
            'template' => 'index.html.twig',
            'data' => array(
                "var" => $var,
            )
        );
    }
}