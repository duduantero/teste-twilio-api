<?php
require_once 'twilio-php-app/vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = $config['sid'];
$token = $config['token'];
$twilio = new Client($sid, $token);

$feedback = $twilio->messages("SMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                   ->feedback
                   ->create(["outcome" => "confirmed"]);
print($feedback->messageSid);