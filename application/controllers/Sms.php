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
							
                $result=$this->sdp->sendSms($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,"254713154085",$correlator,$kmp_code,$kmp_message);
              	echo $result["ResultDetails"] ["result"]."<br />";
				$result=$this->sdp->getSmsDeliveryStatus($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,$result["ResultDetails"] ["result"]);
				var_dump($result);
			}
	}