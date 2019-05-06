<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
    
    public function Post_data()
    {
        return isset($_REQUEST)?$_REQUEST:"";
    }

    public function Ret_Json($var)
    {
        echo json_encode($var);
    }

    public function getStatus()
    {
		$this->output->set_header('Access-Control-Allow-Origin:*');
        $this->Ret_Json($this->_getStatus($this->Post_data()));
    }

    public function _getStatus($args)
    {
        $key = $args['key'];
        $serverId = $args['serverId'];
        
        $deviceStatus = "";
        $planType = "";
        $subscriptions = array();

        return array('deviceStatus' => $deviceStatus, 'planType' => $planType, 'subscriptions' => $subscriptions);

        #获取状态
        # deviceStatus
        # planType
        # subscriptions
        #
    }


    public function validateDevice()
    {
        $this->output->set_header('Access-Control-Allow-Origin:*');
        $this->Ret_Json($this->_validateDevice($this->Post_data()));
    }

    public function _validateDevice($args)
    {
        $serverId = $args['serverId'];
        $deviceId = $args['deviceId'];
        $deviceName = $args['deviceName'];
        $appName = $args['appName'];
        $appVersion = $args['appVersion'];
        $embyUserName = $args['embyUserName'];
        $viewOnly = $args['viewOnly'];

        $cacheExpirationDays = 7;
        $resultCode = "REG";
        $message = "Device Registered";
        return array('cacheExpirationDays' => $cacheExpirationDays, 'resultCode' => $resultCode, 'message' => $message);

        #验证设备
        # cacheExpirationDays
        # status
        # {
        #    "cacheExpirationDays": 7,
        #    "resultCode": "NOTREG",
        #    "message": "Device Not Registered"
        # }
    }

    public function validate()
    {
        $this->output->set_header('Access-Control-Allow-Origin:*');
        $this->Ret_Json($this->_validate($this->Post_data()));
    }

    public function _validate($args)
    {
        $feature = $args['feature'];
        $platform = $args['platform'];
        $ver = $args['ver'];
        $systemid = $args['systemid'];
        $mac = $args['mac'];
        $key = $args['key'];

        $featId = $feature;
        $registered = "true";
        $expDate = "2030-01-01";
        #$key = "";
        return array('featId' => $featId, 'registered' => $registered, 'expDate' => $expDate, 'key' => $key);
        # registered expDate lastChecked isTrial isValid RegisteredAndNotExpired
        #
        # return json 
        # {"featId":null,"registered":false,"expDate":"1900-01-01","key":null}
    }
}
