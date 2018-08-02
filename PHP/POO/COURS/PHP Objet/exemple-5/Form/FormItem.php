<?php 
namespace Form;

abstract class FormItem
{
    protected $name;
    protected $label;
    protected $value;

    public abstract function createView();

    public function __construct($name, $label)
    {
        $this->setName($name);
        $this->setLabel($label);
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

    protected function startView()
    {
        $html = '<div class="form-group">
        <label>' . $this->getLabel() . '</label>';

        return $html;
    }

    protected function endView()
    {
        $html = '</div>';
        return $html;
    }

    public function getValue()
    {
        return $this->value;
    }
 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
 
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
}