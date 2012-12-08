<?php

/*
D I S C L A I M E R                                                                                          
WARNING: ANY USE BY YOU OF THE SAMPLE CODE PROVIDED IS AT YOUR OWN RISK.                                                                                   
Authorize.Net provphpides this code "as is" without warranty of any kind, either express or implied, including but not limited to the implied warranties of merchantability and/or fitness for a particular purpose.
Authorize.Net owns and retains all right, title and interest in and to the Automated Recurring Billing intellectual property.
*/

include_once ("vars.php");
include_once ("api_authorize_net_soap_v1.php");
include_once ("util.php");

echo "Create subscription...<br><br>";

$ws = CreateWSClient();
$req = new ARBCreateSubscription();
$req->merchantAuthentication = PopulateMerchantAuthentication();
$req->subscription = PopulateSubscription($_POST["amount"], FALSE);

try {
	$response = $ws->ARBCreateSubscription($req);
	//echo "Raw request: " . htmlspecialchars($ws->__getLastRequest()) . "<br><br>";
	//echo "Raw response: " . htmlspecialchars($ws->__getLastResponse()) . "<br><br>";
	if ("Ok" == $response->ARBCreateSubscriptionResult->resultCode) {
		echo "Subcription ID <b>"
			. htmlspecialchars($response->ARBCreateSubscriptionResult->subscriptionId)
			. "</b> was successfully created.<br><br>";
	} else {
		echo "The operation failed with the following errors:<br>";
		PrintErrors($response->ARBCreateSubscriptionResult);
	}
} catch (SoapFault $exception) {
	echo $exception . "<br><br>";
}

echo "<br><a href=index.php?subscriptionId="
	. urlencode($response->ARBCreateSubscriptionResult->subscriptionId)
	. ">Continue</a><br>";

?>

