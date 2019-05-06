<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appstore extends CI_Controller {

    public function Postdata()
    {
        return isset($_REQUEST)?$_REQUEST:"";
    }

    public function RetJson($var)
    {
        echo json_encode($var);
    }

    public function register()
    {
        $this->RetJson($this->_register($this->Postdata()));
    }

    public function _register($args)
    {
        $featId = "";
        $registered = "true";
        $expDate = "2030-01-01";
        $key = "";
        return array('featId' => $featId, 'registered' => $registered, 'expDate' => $expDate, 'key' => $key);
        # featId
        # registered
        # expDate
        # key
    }
}