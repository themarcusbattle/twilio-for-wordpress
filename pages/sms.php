<?php
	
	$twilio_number = get_option( 'twilio_number', '' );
	$accountSID = get_option( 'twilio_account_sid', '' );
	$authToken = get_option( 'twilio_auth_token', '' );

?>

<div class="wrap about-wrap">
	<h1>Twilio :: SMS</h1>
	<div class="about-text">"Your web app just learned to text." WordPress speaks SMS.</div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=twilio" class="nav-tab">Settings</a>
		<a href="?page=twilio-features" class="nav-tab">Features</a>
		<a href="?page=twilio-sms" class="nav-tab nav-tab-active">SMS</a>
		<a href="?page=twilio-api" class="nav-tab">API</a>
		<a href="?page=twilio-support" class="nav-tab">Support</a>
	</h2>
	<p class="about-description">For WordPress to talk back to Twilio, you must update your <a href="https://www.twilio.com/user/account/phone-numbers/" target="_blank">Messaging Request URL</a> with the following url: <a href="<?php echo home_url('/twilio/sms') ?>"><?php echo home_url('/twilio/sms') ?></a></p>
	<p>With our custom filter, <a href="?page=twilio-api#twilio_sms_callback">add_filter( 'twilio_sms_callback' )</a>, you can program WordPress to respond with custom messages.</p>
	<p>Once you update your Messaging Request URL, you can test it by sending the word "DEMO" to your Twilio Number.</p>
	<form>
		<input type="hidden" name="twixml" />
	</form>
	<hr />
	<p>Plugin created by <a href="http://marcusbattle.com/plugins/twilio-for-wordpress" target="_blank">Marcus Battle</a>. This plugin is not directly affiliated with <a href="https://twilio.com" target="_blank">Twilio, Inc.</a></p>
</div>

<style type="text/css">
	#sms-editor {
        position: relative;
        width: 500px;
        height: 400px;
    }

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
<script>
    var editor = ace.edit("sms-editor");
    editor.getSession().setMode("ace/mode/xml");
</script>