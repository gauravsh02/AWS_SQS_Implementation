<?php

require 'vendor/autoload.php';

use Aws\Sqs\SqsClient; 
use Aws\Exception\AwsException;

$key = "KEY";
$secret = "SECRET";

// 'profile' => 'default',

$client = new SqsClient([
    'region' => 'us-east-1',
    'version' => '2012-11-05',
    'credentials' => [
        'key' => $key,
        'secret' => $secret
    ]
]);

$params = [
    'DelaySeconds' => 0,
    'MessageAttributes' => [
        "Server" => [
            'DataType' => "String",
            'StringValue' => "Edmingle"
        ],
        "Action" => [
            'DataType' => "String",
            'StringValue' => "BULK_ADD_STUDENT"
        ]
    ],
    'MessageBody' => json_encode(
        array(
            array("param_1" => 1, "param_2" => 2),
            array("param_1" => 3, "param_2" => 4)
        )
    ),
    'QueueUrl' => 'https://sqs.us-east-1.amazonaws.com/QUEUE/demo-queue'
];

try {
    $result = $client->sendMessage($params);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
}
 
 
