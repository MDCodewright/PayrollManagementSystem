<?php

/*
 * Command line script to send an outgoing SMS from the server.
 *
 * This example script queues outgoing messages using the local filesystem.
 * The messages are sent the next time EnvayaSMS sends an ACTION_OUTGOING request to www/gateway.php.
 */

require_once __DIR__."/config.php";
require_once __DIR__."/EnvayaSMS.php";

$message = new EnvayaSMS_OutgoingMessage();
$message->id = uniqid("");
$message->to = "0707440470";
$message->message = "Hello Major. We have disbursed your money. Kindly check your account.";

file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));
    
echo "Message {$message->id} added to filesystem queue\n";
