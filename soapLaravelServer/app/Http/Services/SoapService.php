<?php

namespace App\Http\Services;

use \SoapServer;

class SoapService {

    private $soap;

    public function handler($acction_class)
    {
        $this->soap = new SoapServer(null, array('uri' => 'http://localhost/'));
        $this->soap->setClass(get_class($acction_class));
        $this->soap->handle();
    }

}