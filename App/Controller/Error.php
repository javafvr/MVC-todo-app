<?php

namespace Controller;

class Error extends \App\Controller
{
    public function error404 ()
    {
        return $this->render('error404');
    }
    public function error500 ()
    {
        return $this->render('error500');
    }
}