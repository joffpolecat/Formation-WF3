<?php 

namespace Form;

class TextareaItem extends FormItem
{
    public function createView()
    {
        $html = $this->startView();
        
        $html .= '<textarea name="' . $this->getName() . '" class="form-control" >' . $this->getValue() . '</textarea>';

        $html .= $this->endView();

        return $html;
    }
}