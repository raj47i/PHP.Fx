<html>
<body>
<?php
/*
D I S C L A I M E R                                                                                          
WARNING: ANY USE BY YOU OF THE SAMPLE CODE PROVIDED IS AT YOUR OWN RISK.                                                                                   
Authorize.Net provides this code "as is" without warranty of any kind, either express or implied, including but not limited to the implied warranties of merchantability and/or fitness for a particular purpose.   
Authorize.Net owns and retains all right, title and interest in and to the Automated Recurring Billing intellectual property.
*/

$subscriptionId = NULL;
if (isset($_REQUEST['subscriptionId'])) {
	$subscriptionId = $_REQUEST['subscriptionId'];
}
?>

<form method=post action=subscription_create.php>
<b>Create Subscription</b><br>
amount <input type=text name=amount value='10.95'><br>
<input type=submit name=submit value=submit>
</form>
<hr>

<form method=post action=subscription_update.php>
<b>Update Subscription</b><br>
subscriptionId <input type=text name=subscriptionId value='<?php echo $subscriptionId; ?>'><br>
amount <input type=text name=amount value='9.95'><br>
<input type=submit name=submit value=submit>
</form>
<hr>

<form method=post action=subscription_cancel.php>
<b>Cancel Subscription</b><br>
subscriptionId <input type=text name=subscriptionId value='<?php echo $subscriptionId; ?>'><br>
<input type=submit name=submit value=submit>
</form>
<hr>

</body>
</html>

