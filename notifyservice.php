<?php
require("lib/server_inc.php");
require("lib/parse_notify_soap_header.php");
class SMSNotifyService
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
			}
	}

//Create server object and pass the location of the WSDL file
$server = new SoapServer("wsdl/notifyservice.wsdl");

//set the class to handle various operations
$server->setClass("SMSNotifyService");

//handle the request
$server->handle($post);

?>