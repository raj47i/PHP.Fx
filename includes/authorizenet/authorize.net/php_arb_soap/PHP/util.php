<?php

/*
D I S C L A I M E R                                                                                          
WARNING: ANY USE BY YOU OF THE SAMPLE CODE PROVIDED IS AT YOUR OWN RISK.                                                                                   
Authorize.Net provides this code "as is" without warranty of any kind, either express or implied, including but not limited to the implied warranties of merchantability and/or fitness for a particular purpose.   
Authorize.Net owns and retains all right, title and interest in and to the Automated Recurring Billing intellectual property.
*/

include_once ("vars.php");
include_once ("api_authorize_net_soap_v1.php");

function PrintErrors(/*ANetApiResponseType*/ $response) {
	foreach ($response->messages as $msg) {
		echo "[{$msg->code}] {$msg->text}<br>";
	}
	echo "<br>";
}

function CreateWSClient() {
	global $g_webservicewsdl;
	echo "Web Service WSDL: $g_webservicewsdl <br><br>";
	$ws = new AuthorizeNetWS($g_webservicewsdl /* , array('trace' => 1) */);
	return $ws;
}

function PopulateMerchantAuthentication() {
	global $g_loginname, $g_transactionkey;
	$ret = new MerchantAuthenticationType();
	$ret->name = $g_loginname;
	$ret->transactionKey = $g_transactionkey;
	return $ret;
}

function PopulateSubscription($amount, $bForUpdate = FALSE) {
	$sub = new ARBSubscriptionType();
	$creditCard = new CreditCardSimpleType();

	$sub->name = "Sample subscription";

	$creditCard->cardNumber = "4111111111111111";
	if ($bForUpdate) {
		$creditCard->expirationDate = "2022-08";  // required format for API is YYYY-MM
	} else {
		$creditCard->expirationDate = "2020-08";  // required format for API is YYYY-MM
	}
	$sub->payment = new PaymentType();
	$sub->payment->creditCard = $creditCard;

	$sub->billTo = new NameAndAddressType();
	$sub->billTo->firstName = "John";
	$sub->billTo->lastName = "Smith";

	$sub->amount = $amount;

	// Create a subscription that is 12 monthly payments starting on Mar 15, 2017

	$sub->paymentSchedule = new PaymentScheduleType();
	$sub->paymentSchedule->startDate = "2017-03-15"; // required format for API is YYYY-MM-DD
	$sub->paymentSchedule->totalOccurrences = 12;

	if (!$bForUpdate) { // Interval can't be updated once a subscription is created.
		$sub->paymentSchedule->interval = new PaymentScheduleTypeInterval();
		$sub->paymentSchedule->interval->length = 1;
		$sub->paymentSchedule->interval->unit = "months";
	}
	
	return $sub;
}

?>
