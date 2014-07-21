<?php
	
	$twilio_number = get_option( 'twilio_number', '' );
	$accountSID = get_option( 'twilio_account_sid', '' );
	$authToken = get_option( 'twilio_auth_token', '' );

?>

<div class="wrap about-wrap">
	<h1>Twilio :: SMS</h1>
	<div class="about-text">"<a href="https://twilio.com" target="_blank">Twilio</a> empowers developers to build powerful communication." This plugin harnesses that power and creates hooks and actions for you to extend your plugins.</div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=twilio" class="nav-tab">Settings</a>
		<a href="?page=twilio-features" class="nav-tab">Features</a>
		<a href="?page=twilio-sms" class="nav-tab nav-tab-active">SMS</a>
		<a href="?page=twilio-api" class="nav-tab">API</a>
	</h2>
	<p class="about-description">Help WordPress text back!</p>
	<div class="editor">

	</div>
	<hr />
	<p>Plugin created by <a href="http://marcusbattle.com/plugins/twilio" target="_blank">Marcus Battle</a>. This plugin is not directly affiliated with <a href="https://twilio.com" target="_blank">Twilio, Inc.</a></p>
</div>
