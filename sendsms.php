<?php 

require_once('lib/sdp_utils.php');

//create an instance of the service
$sdp_service=new SDPService();

//SMS parameters
$kmp_service_endpoint="http://196.201.216.14:8310/SendSmsService/services/SendSms";
$kmp_spid="601555";
$kmp_password="@Bcd1234";
$kmp_service_id="6015552000001688";
$kmp_timestamp=date("Ymd");
$kmp_correlator="12345678";
$kmp_code="1041";
$kmp_sppwd=md5($kmp_spid.$kmp_password.$kmp_timestamp);
//$kmp_recipients=array("254723624727","254720265145","254720471865",'254722000001','254722000002','254722000004','254722000005','254722000003','254722000006','254722000007','254722000008');
//$kmp_recipients=array("254723624727","254720265145","254720471865");
$kmp_recipients="254721491491";
$kmp_message="gggggg";

//send SMS
//$result=$sdp_service->sendSms($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_recipients,$kmp_correlator,$kmp_code,$kmp_message);

$kmp_request_identifier="100001200101130526132225720171";
//get sms delivery status
$result=$sdp_service->getSmsDeliveryStatus($kmp_spid,$kmp_sppwd,$kmp_service_id,$kmp_timestamp,$kmp_request_identifier);
print_r($result);
?>
