<?php 

namespace Controller;

/**
 * Contrôleur frontal
 */
class FrontController
{
    private $controller;
    private $action;
    private $params = array();
    private $basePath = BASEPATH;

    public function __construct(array $options = array())
    {
        $this->setController('Index');
        $this->setAction('index');
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options['controller'])) {
                $this->setController($options['controller']);
            }

            if (isset($options['action'])) {
                $this->setAction($options['action']);
            }
            
            if (isset($options['params'])) {
                $this->setParams($options['params']);
            }
        }
        
    }
    
    /**
     * Analyse le lien envoyer 
     */
    public function parseUri()
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
        
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        $path = substr($path, 1);
        $pathData = explode("/", $path, 3);

        if (!empty($pathData[0])) {
            $this->setController($pathData[0]);
        }

        if (!empty($pathData[1])) {
            $this->setAction($pathData[1]);
        }

        if (!empty($pathData[2])) {
            $this->setParams(explode("/", $pathData[2]));
        }
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        $controller = 'Controller\\'. ucfirst(strtolower($controller)) . 'Controller';
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException("The action controller '$controller' has not been defined", 1);
        }

        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of action
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new \InvalidArgumentException("The controller action '$action' has been not defined", 1);
            
        }
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of params
     */ 
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set the value of params
     *
     * @return  self
     */ 
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    public function run()
    {
        return call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }

    /**
     * Get the value of basePath
     */ 
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Set the value of basePath
     *
     * @return  self
     */ 
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }
}