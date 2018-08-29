<?php
/* 
@author: Samuel Kamochu (skamochu@safaricom.co.ke or kamochu@gmail.com)
@created on: 13-03-2013
@version: 1
@description: The code allows to process syncOrderRelation requests from SDP. The code just extracts the critical parameters from the request. The programmer should adapt the code to process the data.
@required: PHP 5 server
20130316: notifySmsReception method included in the class
*/

require("lib/server_inc.php");

/*
 * Parser the raw $post data to extract some critical SOAP Header parameters
 */
require("lib/parse_notify_soap_header.php");


/*
* Class that handles all soap requests sent to notify sms service
*/
class SMSNotifyService{

	/*
	 * Method to process the notifySmsDeliveryReceipt SOAP request from the client
	 * The programmer must save some code to record the parameters received into the database/file for further processing
	 */
	function notifySmsDeliveryReceipt($correlator,$deliveryStatus){
		  global $timeStamp;
		  global $subReqID;
		  global $traceUniqueID;
		  
		  //variables to be saved in  a database or processed
		  $msg_timeStamp=$timeStamp;
		  $msg_subReqID=$subReqID;
		  $msg_traceUniqueID=$traceUniqueID;
		  $msg_correlator=$correlator;
		  $msg_address=$deliveryStatus->address;
		  $msg_deliveryStatus=$deliveryStatus->deliveryStatus;
			  
		  /*
		  * Code to use the data received will appear here. 
		  * You can connect save the data in a database and have it polled by another service.
		  */
	}
	
	/*
	 * Method to process the notifySmsReception SOAP request from the client
	 * The programmer must save some code to record the parameters received into the database/file for further processing
	 */
	function notifySmsReception($correlator,$message){
		//refer to the global variables set by the XML parser from the SOAP header
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
		
		/*
		* Code to use the data received will appear here. 
		* You can connect save the data in a database and have it polled by another service.
		*/
		
		$db_host= "localhost";
		  $db_name= "sms";
		  $db_username = "std_db_ureport";
		  $db_password = "owesome2014!!!!";

		  //open database connection
		  $connection=mysql_connect($db_host,$db_username,$db_password)or die('Could not connect to the database : '.mysql_error());
		
		  mysql_select_db($db_name) or die('Could not select the database : '.mysql_error());
		  
		 /* Method to save the subscription request into the database */
		
		
			$query="insert into notify_sms_reception (msg_spRevId,msg_spRevpassword,msg_spId,msg_serviceID,msg_linkid,msg_traceUniqueID,msg_message,msg_senderAddress,msg_smsServiceActivationNumber,msg_dateTime,msg_timestamp) values ('$msg_spRevId','$msg_spRevpassword','$msg_spId','$msg_serviceId','$msg_linkid','$msg_traceUniqueID','$msg_message','$msg_senderAddress','$msg_smsServiceActivationNumber','$msg_dateTime',NOW())";

			file_put_contents( 'tmp/notifyquery' . time() . '.log', var_export( $query, true));

			//save the data into the db
			$result=mysql_query($query,$connection);

			if (!$result){		
			//file_put_contents('incomquery_error.log',mysql_error());
			}

		   //close database connection
		   mysql_close($connection) or die('Could not close the database connection');
	}
}

//Create server object and pass the location of the WSDL file
$server = new SoapServer("wsdl/notifyservice.wsdl");

//set the class to handle various operations
$server->setClass("SMSNotifyService");

//handle the request
$server->handle($post);

?>