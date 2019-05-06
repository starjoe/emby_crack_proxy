<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller
{
    public function Postdata()
    {
        return isset($_REQUEST)?$_REQUEST:"";
    }

    public function RetJson($var)
    {
        echo json_encode($var);
    }

    public function retrieveall()
    {
        if ($this->input->get('includeAllRuntimes')) {
            $this->load->driver('cache');
            $response = $this->cache->get('PackageInfo');
            if ($response == false) {
                #缓存数据
                $response = $this->_retrieveall($this->Postdata());
                $this->cache->file->save('PackageInfo', json_encode($response), 86400);
            }else{
                //$this->cache->file->clean();
            }
            $this->RetJson($response);
        }
    }

    public function _retrieveall($args)
    {
        $key = $args['key'];
        $mac = $args['mac'];
        $systemid = $args['systemid'];

        $curl = curl_init();
        $postData = "key=$key&mac=$mac&systemid=$systemid";
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.mb3admin.com/admin/service/package/retrieveall?includeAllRuntimes=true",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $result = array('message' => 'Error!');
        } else {
            $result = $this->processData($response);
        }
        return $result;
    }

    public function processData($jsonData)
    {
        #数据处理
        $obj_json = json_decode($jsonData);
        foreach ($obj_json as $key => $obj) {
            if ($obj->isPremium) {
                $obj->price = "0.00";
                $obj->isRegistered = true;
                $obj->expDate = null;
            }
        }
        return $obj_json;
    }
}
