<?php
class config
	{
		/*
		 * Client configuration parameters, e.g various endpoints, logging flags, bulk requests limit, etc
		 */ 
		 
		//startSmsNotification Configs
		public $kmp_start_stop_sms_notification_service_endpoint="http://svc.safaricom.com:8310/SmsNotificationManagerService/services/SmsNotificationManager"; //endpoint on SDP
		public $kmp_start_stop_sms_notification_service_log_soap_messages=1; // log request and responses to the server
		public $kmp_start_stop_sms_notification_service_log_file_prefix="StartStopSmsNotification_"; //log file prefix, timestamp will be appended to log file
		public $kmp_start_stop_sms_notification_service_debug=0; // 1 - debug string to be included, 0 do not include debug str. 

		//sendSMS Configs
		public $kmp_send_sms_service_endpoint="http://svc.safaricom.com:8310/SendSmsService/services/SendSms"; //endpoint on SDP
		public $kmp_send_sms_notify_delivery=1; // 1 - send delivery receipts to $kmp_sms_notify_service_endpoint, 0 do not send
		public $kmp_send_sms_notify_service_endpoint="http://159.65.85.14/sdp/sms/notify";
		public $kmp_send_sms_service_max_recipient=10; //maximum number of recipients in a single send sms request
		public $kmp_send_sms_service_log_soap_messages=1; // log request and responses to the server
		public $kmp_send_sms_service_log_file_prefix="SendSms_"; //log file prefix, timestamp will be appended to log file
		public $kmp_send_sms_service_debug=0; // 1 - debug string to be included, 0 do not include debug str. The $kmp_send_sms_service_log_soap_messages must be set to 1


		//getSmsDeliveryStatus Configs
		public $kmp_get_sms_delivery_status_service_endpoint="http://svc.safaricom.com:8310/SendSmsService/services/SendSms"; //endpoint on SDP
		public $kmp_get_sms_delivery_status_service_log_soap_messages=1; // log request and responses to the server
		public $kmp_get_sms_delivery_status_service_log_file_prefix="SmsDeliveryStatus_"; //log file prefix, timestamp will be appended to log file
		public $kmp_get_sms_delivery_status_service_debug=0; // 1 - debug string to be included, 0 do not include debug str.
	}
?>
