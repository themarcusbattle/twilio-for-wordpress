<?php
	
	$twilio_number = get_option( 'twilio_number', '' );
	$accountSID = get_option( 'twilio_account_sid', '' );
	$authToken = get_option( 'twilio_auth_token', '' );

?>

<div class="wrap about-wrap">
	<h1>Twilio</h1>
	<div class="about-text">"<a href="https://twilio.com" target="_blank">Twilio</a> powers the future of business communications, enabling phones, VoIP, and messaging to be embedded into web, desktop, and mobile software." That power is now available to your WordPress site.</div>
	<h2 class="nav-tab-wrapper">
		<a href="?page=twilio" class="nav-tab nav-tab-active">Settings</a>
		<a href="?page=twilio-features" class="nav-tab">Features</a>
		<a href="?page=twilio-sms" class="nav-tab">SMS</a>
		<a href="?page=twilio-api" class="nav-tab">API</a>
		<a href="?page=twilio-support" class="nav-tab">Support</a>
	</h2>
	<!-- <h3>Twilio Credentials</h3> -->
	<p class="about-description">These details are available in your <a href="https://www.twilio.com/user/account" target="_blank">Twilio dashboard</a> after <a href="https://www.twilio.com/try-twilio" target="_blank">signup</a>. Without them, WordPress won't be able to communicate on your behalf.</p>
	<form action="<?php echo admin_url('options-general.php?page=twilio'); ?>">
		<input type="hidden" name="page" value="twilio">
		<input type="hidden" name="action" value="update">
		<?php wp_nonce_field(); ?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="twilio_number">Twilio Number</label></th>
					<td>
						<input name="twilio_number" type="text" value="<?php echo $twilio_number; ?>" class="regular-text" placeholder="+13362522164">
						<p class="description">Country code + 10-digit Twilio phone number (i.e. +13362522164)</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="accountSID">Account SID</label></th>
					<td>
						<input name="accountSID" type="text" value="<?php echo $accountSID; ?>" class="regular-text">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="authToken">Auth Token</label></th>
					<td><input name="authToken" type="password" value="<?php echo $authToken; ?>" class="regular-text"></td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
		</p>
	</form>
	<hr />
	<p>Plugin created by <a href="http://marcusbattle.com/plugins/twilio-for-wordpress" target="_blank">Marcus Battle</a>. This plugin is not directly affiliated with <a href="https://twilio.com" target="_blank">Twilio, Inc.</a></p>
</div>
