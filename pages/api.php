<?php
	
	$twilio_number = get_option( 'twilio_number', '' );
	$accountSID = get_option( 'twilio_account_sid', '' );
	$authToken = get_option( 'twilio_auth_token', '' );

?>

<div class="wrap about-wrap">
	<h1>Twilio :: API</h1>
	<div class="about-text">"<a href="https://twilio.com" target="_blank">Twilio</a> empowers developers to build powerful communication." This plugin harnesses that power and creates hooks and actions for you to extend your plugins.</div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=twilio" class="nav-tab">Settings</a>
		<a href="?page=twilio-features" class="nav-tab">Features</a>
		<a href="?page=twilio-sms" class="nav-tab">SMS</a>
		<a href="?page=twilio-api" class="nav-tab nav-tab-active">API</a>
		<a href="?page=twilio-support" class="nav-tab">Support</a>
	</h2>
	<p class="about-description">Here are some functions to utilize in your plugin(s). Rember to check if <a href="http://php.net/manual/en/function.function-exists.php" target="_blank">function_exists()</a> before calling any of these functions directly.</p>
	<p>&nbsp;</p>
	<h3>twilio_send_sms( $to, $message, $from = '' )</h3>
	<h4>Description</h4>
	<p>Sends a standard text message from your Twilio Number.</p>
	<h4>Parameters</h4>
	<ul>
		<li><strong>$to</strong> | string | The mobile number that will be texted. Must be formatted as country code + 10-digit number (i.e. +13362522164).</li>
		<li><strong>$message</strong> | string | The message that will be sent to the recipient.</li>
		<li><strong>$from</strong> <i>(optional)</i> | string | Twilio Number message is coming from. Default value is Twilio Number supplied in <a href="?page=twilio">"Settings"</a>.</li>
	</ul>
	<h4>Return</h4>
	<p>Array | Response from Twilio's servers</p>
	<h4>Example</h4>
	<pre>
	$to = "+13362522164";
	$message = "Hello World";

	twilio_send_sms( $to, $message );	
	</pre>

	<p class="clear">&nbsp;</p>
	<h3 id="twilio_sms_callback">add_filter( 'twilio_sms_callback', '[your_callback_function]' , 99, 2 )</h3>
	<h4>Description</h4>
	<p>Modifies the reply SMS message when WordPress receives an SMS</p>
	<h4>Parameters</h4>
	<ul>
		<li><strong>$twixml</strong> | string | The Twilio XML that will serve as the response</li>
		<li><strong>$sms</strong> | array | The current SMS that has been sent to WordPress. Standard parameters are "To","Body","From". More parameters can be found in the <a href="https://www.twilio.com/docs/api/twiml/sms/twilio_request" target="_blank">Twilio Request Documentation</a>.</li>
	</ul>
	<h4>Example</h4>
	<pre>
	function my_twilio_sms_callback( $twixml, $sms ) {

		// Case-insensitive check to see if the SMS only had the word hello in it
		if ( strtolower($sms['Body']) == 'hello' ) {

			$twixml .= "&lt;Message&gt;Hey how are you?!&lt;/Message&gt;";

		}

		return $twixml;

	}

	add_filter( 'twilio_sms_callback', 'my_twilio_sms_callback' , 10, 2 );	
	</pre>
	<p>&nbsp;</p>

	<hr />
	<p>Plugin created by <a href="http://marcusbattle.com/plugins/twilio-for-wordpress" target="_blank">Marcus Battle</a>. This plugin is not directly affiliated with <a href="https://twilio.com" target="_blank">Twilio, Inc.</a></p>
</div>

<style>
	pre {
		background-color: #fff;
		color: #666;
		padding-top: 20px;
		margin-bottom: 20px;

		-moz-tab-size: 2;
	    -o-tab-size:   2;
	    tab-size:      2;

	    line-height: 15px;
	    border: 1px solid #CCC;
	}
</style>
