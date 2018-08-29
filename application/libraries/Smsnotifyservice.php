<?php
require(APPPATH."third_party/lib/server_inc.php");
require(APPPATH."third_party/lib/parse_notify_soap_header.php");
class Smsnotifyservice
	{	
		function notifySmsDeliveryReceipt($correlator,$deliveryStatus)
			{
				global $timeStamp;
				global $subReqID;
				global $traceUniqueID;
				$msg_timeStamp=$timeStamp;
				$msg_subReqID=$subReqID;
				$msg_traceUniqueID=$traceUniqueID;
				$msg_correlator=$correlator;
				$msg_address=$deliveryStatus->address;
				$msg_deliveryStatus=$deliveryStatus->deliveryStatus;
				$data = json_encode(array("timeStamp"=>$timeStamp,"subReqID"=>$subReqID,"traceUniqueID"=>$traceUniqueID,"correlator"=>$msg_correlator,"msg_address"=>$msg_address,"msg_deliveryStatus"=>$msg_deliveryStatus));
				file_put_contents(APPPATH."logs/delivery_".date("Y-m-d").".log", "\n".$data,FILE_APPEND);
			}	
		function notifySmsReception($correlator,$message)
			{				
				global $traceUniqueID;
				global $spRevId;
				global $spRevpassword;
				global $spId;
				global $serviceId;
				global $linkid;
				
				//soap header parameters 
				$msg_spRevId=$spRevId;
				$msg_spRevpassword=$spRevpassword;
				$msg_spId=$spId;
				$msg_serviceId=$serviceId;
				$msg_linkid=$linkid;
				$msg_traceUniqueID=$traceUniqueID;
				
				//soap body parameters
				$msg_message=$message->message;
				$msg_senderAddress=$message->senderAddress;
				$msg_smsServiceActivationNumber=$message->smsServiceActivationNumber;
				$msg_dateTime=$message->dateTime;	
				$data = json_encode(array("msg_spRevId"=>$msg_spRevId,"msg_spRevpassword"=>$msg_spRevpassword,"msg_spId"=>$msg_spId,"msg_serviceId"=>$msg_serviceId,"msg_linkid"=>$msg_linkid,"msg_traceUniqueID"=>$msg_traceUniqueID,"msg_message"=>$msg_message,"msg_senderAddress"=>$msg_senderAddress,"msg_smsServiceActivationNumber"=>$msg_smsServiceActivationNumber,"msg_dateTime"=>$msg_dateTime));
				file_put_contents(APPPATH."logs/received_".date("Y-m-d").".log", "\n".$data,FILE_APPEND);	
			}
	}

//Create server object and pass the location of the WSDL file
$server = new SoapServer(APPPATH."third_party/wsdl/notifyservice.wsdl");

//set the class to handle various operations
$server->setClass("Smsnotifyservice");

//handle the request
$server->handle($post);

?>