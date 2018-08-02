<?php 

namespace Form;

require_once('FormItem.php');

class TextareaItem extends FormItem
{
    public function createView()
    {
        $html = $this->startView();
        $html .= '<textarea class="form-control" name="' . $this->getName() . '" value="' . $this->getValue() . '" rows="3" placeholder="' . $this->getLabel() . '"></textarea>';
        $html .= $this->endView();

        return $html;
    }   
}