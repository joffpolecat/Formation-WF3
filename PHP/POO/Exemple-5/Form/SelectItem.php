<?php 

namespace Form;

use Entity\User;
use \Entity\Produit\User as ProduitUser;

class SelectItem extends FormItem
{

    private $options;

    public function __construct($name, $label, $options)
    {
        $this->setOptions($options);
        parent::__construct($name, $label);

        $user = new \Entity\User("Piote2", "Azerty2", "superemail2@gmail.com", "PL");
    }
    
    public function createView()
    {
        $html = $this->startView();
        $html .= '<select class="form-control" name="' . $this->getName() . '" />';

        foreach ($this->getOptions() as $key => $value) {
            /*
                $value == "val" ? "OUI" : "NON"
                if($value == "val"){$result = "OUI";} else {$result = "NON";}
            */
            $html .= '<option value="' . $value . '"' . (($value == $this->getValue())? 'selected': '') . '>' . $key . '</option>';
        }

        $html .= '</select>';
        $html .= $this->endView();

        return $html;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }
}