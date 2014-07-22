<?php

/**
 * Plugin Name: Twilio for WordPress
 * Plugin URI: http://marcusbattle.com/plugins/twilio
 * Description: Creates a hook to use in your WordPress plugins to send a text message
 * Version: 0.1.0
 * Author: Marcus Battle
 * Author URI: http://marcusbattle.com
 * License:. GPL2
 */

include_once('inc/twilio-php/Services/Twilio.php');

/**
* Sends a standard text message to the supplied phone number
* @param $to | Recipient of sms message
* @param $message | Message to recipient
* @param $from | Twilio number for WordPress to send message from
* @return array | $response
* @since 0.1.0
*/
function twilio_send_sms( $to, $message, $from = '' ) { 

	$AccountSID = get_option( 'twilio_account_sid', '' );;
    $AuthToken = get_option( 'twilio_auth_token', '' );;

    if ( empty($from) ) 
    	$from = get_option( 'twilio_number', '' );

    $client = new Services_Twilio( $AccountSID, $AuthToken );

	$response = $client->account->messages->sendMessage(
		$from, // From a valid Twilio number
	  	$to, // Text this number
	  	$message
	);

	$response = json_decode( $response );

	return $response;

}


/**
* Builds the Twilio settings menus 
* @since 0.1.0
*/
function twilio_admin_menu() {
	add_options_page( 'Twilio', 'Twilio', 'manage_options', 'twilio', 'twilio_page_settings');
	add_submenu_page( NULL, 'Twilio Features', 'Twilio Features', 'manage_options', 'twilio-features', 'twilio_page_features');
	add_submenu_page( NULL, 'Twilio Developers', 'Twilio Developers', 'manage_options', 'twilio-api', 'twilio_page_api');
	add_submenu_page( NULL, 'Twilio SMS', 'Twilio SMS', 'manage_options', 'twilio-sms', 'twilio_page_sms');
	// add_submenu_page( NULL, 'Twilio Voice', 'Twilio Voice', 'manage_options', 'twilio-voice', 'twilio_page_voice');
}

add_action( 'admin_menu', 'twilio_admin_menu' );


/**
* Displays the 'Home' page in settings
* @since 0.1.0
*/
function twilio_page_settings() {
	include_once( 'pages/index.php' );
}


/**
* Displays the 'Home' page in settings
* @since 0.1.0
*/
function twilio_page_features() {
	include_once( 'pages/features.php' );
}


/**
* Displays the 'Developers' page in settings
* @since 0.1.0
*/
function twilio_page_api() {
	include_once( 'pages/api.php' );
}


/**
* Displays the 'SMS' page in settings
* @since 0.1.0
*/
function twilio_page_sms() {
	include_once( 'pages/sms.php' );
}


/**
* Saves the settings from the options pages for Twilio
* @since 0.1.0
*/
function twilio_page_save_settings() {

	if ( isset($_GET['action']) && ( $_GET['action'] == 'update' ) ) {

		if ( $_GET['page'] == 'twilio' ) {
			
			update_option( 'twilio_account_sid', $_GET['accountSID'] );
			update_option( 'twilio_auth_token', $_GET['authToken'] );
			update_option( 'twilio_number', $_GET['twilio_number'] );

		}

		// Redirect back to settings page after processing
		$goback = add_query_arg( 'settings-updated', 'true',  wp_get_referer() );
		wp_redirect( $goback );

	}

}

add_action( 'init', 'twilio_page_save_settings' );


/**
*
*/
function twilio_user_contactmethods( $user_contact ) {

	$user_contact['mobile'] = __('Mobile'); 

	return $user_contact;
}

add_filter('user_contactmethods', 'twilio_user_contactmethods');


/**
*
* @since 0.1.0
*/
function twilio_admin_scripts() {

	echo plugins_url( '/assets/js/ace/lib/ace/ace.js', __FILE__ );

	wp_register_script( 'ace-editor', plugins_url( '/assets/js/ace/lib/ace/ace.js', __FILE__ ), '', '', true );
	wp_enqueue_script( 'ace-editor' );

}

add_action( 'admin_enqueue_scripts', 'twilio_admin_scripts' );


?>