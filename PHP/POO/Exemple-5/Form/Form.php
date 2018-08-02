<?php 

namespace Form;

require_once('FormItem.php');

class Form
{
    private $name;
    private $method;
    private $action;
    private $attr; // ARRAY
    private $items;
    private $data; // Objet
    private $dateCreate;
    private $submitLabel;

    public function __construct($name, $method = 'POST', $action = "", $attr = array())
    {
        $this->setName($name);
        $this->setMethod($method);
        $this->setAttr($attr);
        $this->items = array();
        $this->dateCreate = new \DateTime;
        $this->setSubmitLabel("Envoyer");
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
 
    public function getAttr() : array
    {
        return $this->attr;
    }
 
    public function setAttr(array $attr) // array ('class' => 'form')
    {
        $this->attr = $attr;

        return $this;
    }

    public function createView()
    {
        $html = '<form name="' 
        . $this->getName() 
        . '" method="' 
        . $this->getMethod()
        . '" action="' 
        . $this->getAction()
        . '"'
        ;

        foreach ($this->getAttr() as $key => $value) {
            $html .= $key . '="' . $value . '" ';
        }

        $html .= '>';

        // Créé le code HTML des items
        foreach ($this->getItems() as $key => $item) {
            $methode = "get" . ucfirst($item->getName());
            if(method_exists($this->data, $methode))
            {
                $item->setValue($this->data->$methode());
            }
            
            $html .= $item->createView();
        }

        // Bouton Submit
        $html .= $this->getSubmitView();

        $html .= '</form>';

        return $html;
    }

    public function addItem(FormItem $item)
    {
        $this->items[$item->getName()] = $item;

        /*
            $this->items['username']
        */
    }

    public function getItem($name)
    {
        if(!isset($this->items[$name]))
        {
            return null;
        }

        return $this->items[$name];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        if(is_object($data))
        {
            $this->data = $data;
        }
        else
        {
            trigger_error("Data n'est pas un objet");
        }

        return $this;
    }

    public function getSubmitView()
    {
        $html = '<button type="submit" class="btn btn-primary">' . $this->getSubmitLabel() . '</button>';
        return $html;
    }
    
    private function getSubmitLabel()
    {
        return $this->submitLabel;
    }

    private function setSubmitLabel($submitLabel)
    {
        $this->submitLabel = $submitLabel;

        return $this;
    }

    public function __clone()
    {
        echo "L'objet Form est cloné </br>";

        foreach ($this->items as $key => $value) 
        {
            $this->items[$value->getName()] = clone($value);
        }

        $this->data = clone($this->data);
    }

    public function __sleep()
    {
        echo "Objet Form sérializé </br>";
        return ["name", "method"];
    }
}
