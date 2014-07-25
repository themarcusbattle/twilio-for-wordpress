<?php
	
	$twilio_number = get_option( 'twilio_number', '' );
	$accountSID = get_option( 'twilio_account_sid', '' );
	$authToken = get_option( 'twilio_auth_token', '' );

?>

<div class="wrap about-wrap">
	<h1>Twilio :: Features</h1>
	<div class="about-text">"Communications power business. <a href="https://twilio.com" target="_blank">Twilio</a> powers communications." WordPress now speaks SMS.</div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=twilio" class="nav-tab">Settings</a>
		<a href="?page=twilio-features" class="nav-tab nav-tab-active">Features</a>
		<a href="?page=twilio-sms" class="nav-tab">SMS</a>
		<a href="?page=twilio-api" class="nav-tab">API</a>
		<a href="?page=twilio-support" class="nav-tab">Support</a>
	</h2>
	<p class="about-description">Twilio boasts a robust API for VoIP, SMS, MMS, Browser Calling and <a href="https://www.twilio.com/products" target="_blank">more</a>. Currently, this plugin only supports SMS.</p>
	<h3>Quick Overview</h3>
	<h4>Mobile Phone User Field</h4>
	<p>All users now have a mobile phone number field in their profile.</p>
	<h4>Callback Demo</h4>
	<p>Test that Twilio is working by texting the word "DEMO" to your website at <?php echo $twilio_number; ?>.</p>
	<h4>twilio_send_sms( )</h4>
	<p>Function that allows you to send an SMS from any of your plugins/themes.</p>
	<h4>add_filter( 'twilio_sms_callback' )</h4>
	<p>Custom filter that allows you to define the behavior and response when WordPress receives an SMS.</p>

	<p>&nbsp;</p>
	<h3>Request Features</h3>
	<p>Requests for new features, bugs or fixes can be emailed to <a href="mailto:marcus@marcusbattle.com">marus@marcusbattle.com</a> or submitted via the <a href="https://github.com/marcusbattle/twilio-for-wordpress" target="_blank">github page.</a></p>
	<p class="clear">&nbsp;</p>
	<hr />
	<p>Plugin created by <a href="http://marcusbattle.com/plugins/twilio-for-wordpress" target="_blank">Marcus Battle</a>. This plugin is not directly affiliated with <a href="https://twilio.com" target="_blank">Twilio, Inc.</a></p>
</div>
