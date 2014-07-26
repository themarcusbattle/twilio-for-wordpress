<?php

/**
 * Plugin Name: Twilio for WordPress
 * Plugin URI: http://marcusbattle.com/plugins/twilio-for-wordpress
 * Description: Allows developers to extend the Twilio API into WordPress and build exciting communication based themes and plugins. Comes with SMS support to text users from your themes or plugins. VoIP coming soon.
 * Version: 0.1.0
 * Author: Marcus Battle
 * Author URI: http://marcusbattle.com/plugins
 * License: GPLv2 or later
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
	add_submenu_page( NULL, 'Twilio Support', 'Twilio Support', 'manage_options', 'twilio-support', 'twilio_page_support');
}

add_action( 'admin_menu', 'twilio_admin_menu' );


/**
* Displays the 'Home' page in settings
* @since 0.1.0
*/
function twilio_page_settings() {
	include_once( 'pages/settings.php' );
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
* Displays the 'SMS' page in settings
* @since 0.1.0
*/
function twilio_page_support() {
	include_once( 'pages/support.php' );
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
* Adds a mobil phone field to each user profile
* @since 0.1.0
*/
function twilio_user_contactmethods( $user_contact ) {

	$user_contact['mobile'] = __('Mobile'); 

	return $user_contact;
}

add_filter('user_contactmethods', 'twilio_user_contactmethods');


/**
* Load the admin scripts to power plugin
* @since 0.1.0
*/
function twilio_admin_scripts() {

	wp_register_script( 'twilio', plugins_url( '/assets/js/twilio.admin.js', __FILE__ ), array('jquery'), '', true );
	wp_enqueue_script( 'twilio' );

	wp_register_script( 'ace-editor', plugins_url( '/assets/js/ace/src-min/ace.js', __FILE__ ), '', '' );
	wp_enqueue_script( 'ace-editor' );

}

add_action( 'admin_enqueue_scripts', 'twilio_admin_scripts' );


/**
* Setups up routing to process the callbacks from Twilio
* @since 0.1.0
*/
function twilio_callbacks() {

	// Parse the uri
	$uri = parse_url( $_SERVER['REQUEST_URI'] );
	$uri['path'] = str_replace( home_url( '', 'relative' ) , '', $uri['path'] );
	$uri['path'] = trailingslashit( $uri['path'] );

	$sms = $_REQUEST;

	// Callback for Twilio SMS
	if ( $uri['path'] == '/twilio/sms/' ) {

		$sms['Body'] = isset($sms['Body']) ? $sms['Body'] : '';
		$twixml = '';

		// do_action( 'twilio_sms_callback', $query, $twixml );
		$twixml = apply_filters( 'twilio_sms_callback', $twixml, $sms );

		header("Content-type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		echo "<Response>";
		echo $twixml;
		echo "</Response>";

		exit;

	// Callback for Twilio Voice
	} else if ( $uri['path'] == '/twilio/voice/' ) {

		header("Content-type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		echo "<Response>";
		echo $twixml;
		echo "</Response>";

		exit;

	}

}

add_action( 'init', 'twilio_callbacks' );
	

/**
* Standard call back that converts SMS replies into a conversation
* @since 0.1.0
*/
function twilio_sms_callback( $twixml, $sms ) {

	return $twixml;
	
}

add_filter( 'twilio_sms_callback', 'twilio_sms_callback', 99, 2 );


/**
* Demo response for SMS callback. Activated by texting "DEMO" to Twilio Number
* @since 0.1.0
*/
function twilio_sms_callback_demo( $twixml, $sms ) {

	if ( strcasecmp( $sms['Body'], 'demo' ) == 0 ) {

		$site_name = get_bloginfo('name');
		$site_url = home_url();

		$twixml .= "<Message>You just received a text message from $site_name. Read more at $site_url</Message>";
	}

	return $twixml;
	
}

add_filter( 'twilio_sms_callback', 'twilio_sms_callback_demo', 98, 2 );


/**
* Callback that allows admins to post via SMS
* @since 0.1.1
*/
function twilio_sms_callback_new_status( $twixml, $sms ) {

	// See if any admin has the supplied mobile phone number
	$args = array(
		'role' => 'administrator',
		'meta_query' => array(
			array(
				'key' => 'mobile',
				'value' => $sms['From'],
				'compare' => 'LIKE'
			)
		)
	);

	$user = get_users( $args );

	// Define the action we're looking for in the SMS
	$action = 'status ';
	$action_pos = stripos( $sms['Body'], $action );

	$post_length = strlen( $sms['Body'] );

	// Return error message if post is too long
	if ( $post_length >= 140 ) {

		$twixml .= "<Message>Your status is too long ($post_length characters). Please shorten to a max of 140 characters and resend!</Message>";
		return $twixml;

	}
	
	// Run function, if our action is present and post is the correct length
	if ( $action_pos === 0 ) {

		$post_content = substr( $sms['Body'], strlen( $action ) );
		
		// Create the title with the first 10 words
		$post_title_parts = array_slice( explode( ' ', $post_content ), 0, 10 );
		$post_title = implode( ' ', $post_title_parts );

		$post_args = array(
			'post_content' => ucfirst($post_content),
			'post_status' => 'publish',
			'post_title' => $post_title,
			'tags_input' => array( 'via sms' )
		);

		$post_id = wp_insert_post( $post_args );

		$post_permalink = untrailingslashit(get_permalink( $post_id ));

		if ( $post_id ) {

			set_post_format( $post_id, 'status' );

			$twixml .= "<Message>Your status has been posted! $post_permalink. Reply DELETE, to delete status.</Message>";

		} else {

			$twixml .= "<Message>There was a problem posting your status.</Message>";

		}
	}

	return $twixml;
	
}

add_filter( 'twilio_sms_callback', 'twilio_sms_callback_new_status', 98, 2 );

?>