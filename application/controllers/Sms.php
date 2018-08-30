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
		public function startnotification($service_id,$correlator,$code,$criteria=NULL)
			{
				$kmp_notify_endpoint="http://159.65.85.14/sdp/sms/notify";
				$result=$this->sdp->startSmsNotification($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,$kmp_notify_endpoint,$correlator,$code,$criteria);
				print_r($result);
				echo $json_string = json_encode($result); 
			}
		public function stopnotification($service_id,$correlator)
			{
				$result=$this->sdp->stopSmsNotification($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,$correlator);
				print_r($result);
			}
		public function generatesppwd()
			{
				return md5($this->data->spid.$this->data->pass.$this->data->timestamp);
			}
		public function sendsms()
			{
				$message        = 	$this->input->post("msg");
				$telno          =   $this->input->post("telno");
				$service_id 	= 	6014562000157375;
				$correlator 	= 	2027020270;
				$kmp_code   	=	20270;				
				$linkid			=	$this->input->post("linkid")?$this->input->post("linkid"):NULL;		
                $result=$this->sdp->sendSms($this->data->spid,$this->generatesppwd(),$service_id,$this->data->timestamp,$telno,$correlator,$kmp_code,$message,$linkid);
        		print_r($result);
			}
		public function notify()
			{
				include_once(APPPATH."libraries/Smsnotifyservice.php");
			}
		public function datasync()
			{
				include_once(APPPATH."libraries/Datasyncservice.php");
			}
	}