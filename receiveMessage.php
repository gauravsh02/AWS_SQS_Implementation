<?php

require 'vendor/autoload.php';

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

$key = "KEY";
$secret = "SECRET";

$queueUrl = "https://sqs.us-east-1.amazonaws.com/QUEUE/demo-queue";

$client = new SqsClient([
    'region' => 'us-east-1',
    'version' => '2012-11-05',
    'credentials' => [
        'key' => $key,
        'secret' => $secret
    ]
]);

try {
    $result = $client->receiveMessage(array(
        'AttributeNames' => ['SentTimestamp'],
        'MaxNumberOfMessages' => 1,
        'MessageAttributeNames' => ['All'],
        'QueueUrl' => $queueUrl,
        'WaitTimeSeconds' => 20,
    ));
    if (!empty($result->get('Messages'))) {

        var_dump($result->get('Messages')[0]);

        // changing visibility
        $visRes = $client->changeMessageVisibility([
            'QueueUrl' => $queueUrl,
            'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle'],
            'VisibilityTimeout' => 3600,
        ]);
        // VisibilityTimeout : in Sec Max 43200 (12h)

        // var_dump($visRes);
        // processing here

        $result = $client->deleteMessage([
            'QueueUrl' => $queueUrl,
            'ReceiptHandle' => $result->get('Messages')[0]['ReceiptHandle']
        ]);
    } else {
        echo "No messages in queue. \n";
    }
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
}