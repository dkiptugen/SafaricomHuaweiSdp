<?php 

require_once('lib/sdp_utils.php');

//create an instance of the service
$sdp_service=new SDPService();

$kmp_service_id=6013962000006467; //$_GET['kmp_service_id']; // Service ID 
$kmp_code=22455; //$_GET['kmp_code'];
$kmp_correlator=2245501; //$_GET['kmp_correlator']; // Correlator - to be used in stopSmsNotification request

//details
$kmp_service_endpoint="http://196.201.216.13:8310/SmsNotificationManagerService/services/SmsNotificationManager"; //SDP SendSMS service
$kmp_spid=601396; // SP ID on SDP
$kmp_password="w3bP4s0lun3t"; //SP Password
$kmp_timestamp=date("yyyy-mm-dd H:i:s"); //Time stamp
$kmp_criteria='2245501';
$kmp_notify_endpoint="http://41.72.208.45/sdp/notifyservice.php"; //End SDP should send SMS to via notifySmsReception interface
$kmp_sppwd=md5($kmp_spid.$kmp_password.$kmp_timestamp);


//$kmp_recipients=array("254723624727","254720265145","254720471865",'254722000001','254722000002','254722000004','254722000005','254722000003','254722000006','254722000007','254722000008');
//$kmp_recipients=array("254723624727","254720265145","254720471865");
$kmp_recipients="254721491491";
$kmp_message="This is kamochu";

//send SMS
$result=$sdp_service->sendSms($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$kmp_message);

$kmp_request_identifier="100001200401130527080158019110";
//get sms delivery status
//$result=$sdp_service->getSmsDeliveryStatus($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_request_identifier);
//$kmp_criteria='hehe';
//$kmp_notify_endpoint='http://kilele.co.ke/kempes/notifyservice.php';
//$result=$sdp_service->startSmsNotification($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_notify_endpoint,$kmp_correlator,$kmp_code,$kmp_criteria);
//print_r($result);

//$result=$sdp_service->stopSmsNotification($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_correlator);
print_r($result);

?>
