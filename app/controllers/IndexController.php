<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->pick('index/index');
    }
}

