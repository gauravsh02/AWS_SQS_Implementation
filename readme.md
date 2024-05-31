# AWS SQS

Every API interaction is billed as a quantity of `ceil (payload_size_kb / 64kb)` requests
Each request (send, receive, empty receive) is billed as a number of requests ranging from 1 to 4 (**256kb** is the maximum payload).


## sendMessage

**MessageId** : An attribute containing the MessageId of the message sent to the queue.
  
**DelaySeconds** : The length of time, in seconds, for which to delay a specific message. Valid values: 0 to 900. Maximum: 15 minutes. Messages with a positive DelaySeconds value become available for processing after the delay period is finished. If you don't specify a value, the default value for the queue applies.


## receiveMessage  

**WaitTimeSeconds** : The duration (in seconds) for which the call waits for a message to arrive in the queue before returning. If a message is available, the call returns sooner than WaitTimeSeconds. If no messages are available and the wait time expires, the call returns successfully with an empty list of messages. max 20 for second long poll.

**MaxNumberOfMessages** : The maximum number of messages to return. Amazon SQS never returns more messages than this value (however, fewer messages might be returned). Valid values: 1 to 10. Default: 1.


## changeMessageVisibility

**VisibilityTimeout** : The duration (in seconds) that the received messages are hidden from subsequent retrieve requests after being retrieved by a ReceiveMessage request. Max 43200 (12h).

## Resource

**Monitoring** [AWS SQS Monitoring](https://docs.aws.amazon.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/sqs-monitoring-using-cloudwatch.html)

## Reference

**Doc** [AWS SQS Doc](https://docs.aws.amazon.com/AWSSimpleQueueService/latest/APIReference/Welcome.html)
**SDK** [AWS PHP SDK](https://github.com/aws/aws-sdk-php)