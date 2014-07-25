If you've ever wanted to add text messaging functionality to your website or app, <a href="https://twilio.com" target="_blank">Twilio</a> is one of the best solutions on the market. Twilio has been used to build SMS and VoIP communication in some of the most amazing products such as <a href="http://hulu.com" target="_blank">Hulu</a>, <a href="https://www.airbnb.com/" target="_blank">AirBnB</a> and <a href="https://www.sendhub.com/" target="_blank">Sendhub</a>. They're reasonably priced and have an excellent API. 

<p><img class="alignnone size-medium wp-image-100" src="http://marcusbattle.lemonboxcreative.com/wp-content/uploads/sites/4/2014/07/twilio-logo-300x100.png" alt="twilio-logo" width="300" height="100" />.</p>

<blockquote>"Twilio powers the future of business communications, enabling phones, VoIP, and messaging to be embedded into web, desktop, and mobile software."</blockquote>

What is Twilio for WordPress?
-

This plugin allows developers to extend the <a href="https://twilio.com" target="_blank">Twilio API</a> into WordPress and build exciting communication based themes and plugins. (Yes it's free to download and <a href="http://chrislema.com/gpl-themes-plugins/" target="_blank">GPL</a>).


How does it work?
-

Currently, the plugin only supports SMS functionality, but the plan is to add VoIP within the upcoming months. The plugin primarily allows a WordPress developer to build on top of Twilio directly within their theme or plugin by providing custom functions, hooks and filters. Here's a list of what the plugin provides out of the box:

- Mobile Phone User Field added to each profile
- Custom function to easily send SMS messages to any number (including international ones)
- Custom filter to modify the response WordPress gives when a user texts your Twilio number

<h3>twilio_send_sms( $to, $message, $from = '' )</h3>
<p>Sends a standard text message from your Twilio Number.</p>
Parameter | Type | Description
------------- | ------------- | ----
$to | string | The mobile number that will be texted. Must be formatted as country code + 10-digit number (i.e. +13362522164).
$message | string | The message that will be sent to the recipient.
$from | string | Twilio Number message is coming from. Must be formatted as country code + 10-digit number. Default value is Twilio Number.

Returns an array with response from Twilio's servers
<h5>Example</h5>

```php
$to = "+13362522164";
$message = "Hello World"; 

twilio_send_sms( $to, $message );	
```

<h3 id="twilio_sms_callback">add_filter( 'twilio_sms_callback', '[your_callback_function]' , 99, 2 )</h3>
Modifies the reply SMS message when WordPress receives an SMS

Parameter | Type | Description
----------|------|------------
$twixml   | string | The Twilio XML that will serve as the response
$sms      | array  | The current SMS that has been sent to WordPress. Standard parameters are "To","Body","From". More parameters can be found in the <a href="https://www.twilio.com/docs/api/twiml/sms/twilio_request" target="_blank">Twilio Request Documentation</a>.
<h4>Example</h4>
```php
function my_twilio_sms_callback( $twixml, $sms ) {

  // Case-insensitive check to see if the SMS only had the word hello in it
  if ( strcasecmp( $sms['Body'], 'hello' ) == 0 ) {

    $twixml .= "<Message>Hey how are you?!</Message>";

  }

  return $twixml;

}

add_filter( 'twilio_sms_callback', 'my_twilio_sms_callback' , 10, 2 );	
```
	
<h5>Copyright</h5>
Plugin created by <a href="http://marcusbattle.com/plugins/twilio-for-wordpress">Marcus Battle</a>. 

Disclaimer: This plugin is not directly supported by Twilio,Inc. Please do not contact them for support as they will not be able to help you with it. All logos and trademarks are the property of their respective owners.
