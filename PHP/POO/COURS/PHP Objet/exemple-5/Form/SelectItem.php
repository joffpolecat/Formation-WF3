<?php 
namespace Form;

class SelectItem extends FormItem 
{
    private $options;
    
    public function __construct($name, $label, array $options)
    {
        $this->setOptions($options);
        parent::__construct($name, $label);
    }

    public function createView()
    {
        $html = $this->startView();
        $html .= '<select class="form-control" name="' . $this->getName() . '" >';
        /*
        $result = $value == "val" ? "OUI" : "NON";
        if ($value == "val") { $result = "OUI"; } else { $result = "NON"; }
        */
        foreach ($this->getOptions() as $key => $value) {
            $html .= '<option value="' . $value . '" '.(($value == $this->getValue())? 'selected':'').' >' . $key . '</option>';
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