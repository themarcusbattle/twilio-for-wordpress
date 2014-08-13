<?php

// Set up the Database Schema
function twilio_database_schema() {

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	global $wpdb;

	// Create/modify connections table
	$subscribers_table = $wpdb->prefix . "twilio_subscribers";

	$subscribers_table_sql = "CREATE TABLE $subscribers_table (
	subscriber_id mediumint(9) NOT NULL AUTO_INCREMENT,
	mobile_number VARCHAR(64) NOT NULL,
	mobile_city VARCHAR(256) NOT NULL,
	mobile_state VARCHAR(256) NOT NULL,
	mobile_zip VARCHAR(256) NOT NULL,
	mobile_country VARCHAR(256) NOT NULL,
	subscriber_status SMALLINT(1) NOT NULL DEFAULT 1,
	date_subscribed TIMESTAMP,
	UNIQUE KEY subscriber_id (subscriber_id)
	);";

	dbDelta( $subscribers_table_sql );

}

add_action('admin_init', 'twilio_database_schema' );
