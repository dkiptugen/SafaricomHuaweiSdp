<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller 
	{
		public $data;
        public $sdp;
        public function __construct()
        	{
        		parent::__construct();
        		include(APPPATH."third_party/lib/sdp_utils.php");
        		$this->sdp  =  new SDPService();	
        		$this->data =  (object)[
						        			"spid" => "601456",
						        			"pass" => "#StdGrp.1970!",
						        			"timestamp" => date("Ymd")
						        		];
        	}
		public function startnotification()
			{
				$this->load->view('welcome_message');
			}
		public function stopnotification()
			{

			}
		public function generatesppwd()
			{
				return md5($this->data->spid.$this->data->pass.$this->data->timestamp);
			}
		public function sendsms($service_id,$correlator,$kmp_code,$kmp_message)
			{
							
                $result=$this->sdp->sendSms($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,array("254713154085","254713148129"),$correlator,$kmp_code,$kmp_message);
                var_dump($result);
				// $result=$sdp_service->getSmsDeliveryStatus($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_request_identifier);
			}
	}