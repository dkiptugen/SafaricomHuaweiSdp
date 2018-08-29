<?php
require(APPPATH."third_party/lib/server_inc.php");
class Datasyncservice
	{	
		function syncOrderRelation($userID,$spID,$productID,$serviceID,$serviceList,$updateType,$updateTime,$updateDesc,$effectiveTime,$expiryTime)
			{
	  	  
				$msg_msisdn=$userID->ID;
				$msg_spID=$spID;
				$msg_productID=$productID;
				$msg_serviceID=$serviceID;
				$msg_serviceList=$serviceList;
				$msg_updateType=$updateType;
				$msg_updateTime=$updateTime;
				$msg_updateDesc=$updateDesc;
				$msg_effectiveTime=$effectiveTime;
				$msg_expiryTime=$expiryTime;
				
				 /*
				  * Code to use the data received will appear here. 
				  * You can connect save the data in a database and have it polled by another service.
				  */
			  
				return array("result"=>0,"resultDescription"=>"OK");
			}
	}

//Create server object and pass the location of the WSDL file
$server = new SoapServer(APPPATH."third_party/wsdl/datasyncservice.wsdl");

//set the class to handle various operations
$server->setClass("Datasyncservice");

//handle the request
$server->handle($post);

?>