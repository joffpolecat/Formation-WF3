<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;

class Builder
{
    private $factory;
    private $tokenStorage;

    public function __construct(FactoryInterface $factory, $tokenStorage = null)
    {
        $this -> factory = $factory;
        $this -> tokenStorage = $tokenStorage;
    }

    public function createAdminMenu()
    {
        $menu = $this -> factory -> createItem('root');
        $menu -> setChildrenAttribute('class', 'navbar-nav');

        $parent = $menu -> addChild('article.article', ['route' => 'app_admin_article_index']);
        $parent -> addChild('article.list', ['route' => 'app_admin_article_index']);
        $parent -> addChild('article.add', ['route' => 'app_admin_article_index']);

        $menu -> addChild('category.category', ['route' => 'app_admin_category_index']);
        return $menu;
    }

    public function createMainMenu()
    {
        $menu = $this -> factory -> createItem('root');
        $menu -> setChildrenAttribute('class', 'navbar-nav');
        $menu -> addChild('article.article', ['route' => 'app_article_index']);
        return $menu;
    }

    public function createUserMenu()
    {
        $user = $this -> tokenStorage -> getToken() -> getUser();

        $menu = $this -> factory -> createItem('root');
        $menu -> setChildrenAttribute('class', 'navbar-nav');
        
        $parent = $menu 
            -> addChild($user->getUsername(), ['uri' => '#'])
            -> setExtra('translation_domain', false)
        ;
        
        $parent -> addChild('logout', ['route' => 'fos_user_security_logout']);
        return $menu;
    }


}