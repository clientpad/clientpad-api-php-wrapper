<?php

namespace clientpad\api;

class CPWrapper
{

	/**
	*
	*/
	public $auth_name;
	
	/**
	*
	*/
	public $auth_pass;

	/**
	*
	*/
	public $site_url;

	/**
	*
	*/
	public function sendRequest($uri, $data)
	{

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->site_url . $uri);
        curl_setopt($ch, CURLOPT_USERPWD, $this->auth_name . ":" . $this->auth_pass);

        //if data exsist then send POST else send GET
        if(!empty($data)){
            $data_string = http_build_query($data);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode($data_string));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //loging errors TODO: FOR ALPHA only
       	$fp = fopen(dirname(__FILE__) . '/errorlog.txt', 'w');

       	curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_STDERR, $fp);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        return json_decode($result);
    }
	
    /**
	*
	*/
	public function createOrder($data)
	{
		$uri = '/api/orders';

		//проверим на строку
		if (is_string($data)) {
			$data = [
				'body' => $data,
			];
		} else {
			$data = [
				'body' => "Заявка с сайта " . $_SERVER['HTTP_HOST']
			];
		}

		return $this->sendRequest($uri,$data);
	}	
}
