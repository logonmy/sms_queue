<?php
/*
 * 从主queue获取消息，然后向服务商接口发送
 */
include_once(__DIR__ . '/config.php');

use Filix\SMS\Queue\RedisQueue;
use Filix\SMS\Customer\PrimaryCustomer;
use Filix\SMS\SmsService\BWService;

$redis = new Redis();
$redis->connect(REDIS_HOST, REDIS_PORT);
$queue = new RedisQueue($redis, PRIMARY_CHANNEL);
$secondaryQueue = new RedisQueue($redis, SECONDARY_CHANNEL);

$customer = new PrimaryCustomer($queue, new BWService(), $secondaryQueue);

//while (1){
    $result = $customer->fetchAndSend(1);
//    sleep(5);
//}
