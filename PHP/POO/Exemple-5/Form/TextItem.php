<?php 

namespace Form;

require_once('FormItem.php');

class TextItem extends FormItem
{
    public function createView()
    {
        $html = $this->startView();
        $html .= '<input type="text" class="form-control" name="' . $this->getName() . '" value="' . $this->getValue() . '" />';
        $html .= $this->endView();

        return $html;
    }   
}