<?php

class CommonAction extends CAction
{

    public function render($view, array $options = array())
    {
        $this->getController()->render($view, $options);
    }

}
