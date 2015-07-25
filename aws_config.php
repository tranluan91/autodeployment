<?php

$configEc2 = [
    'credentials' => [
        'key' => 'your_ec2_key',
        'secret' => 'your_ec2_secret',
    ],
    'region' => 'ap-southeast-1',
    'version' => '2015-04-15',
];

$configS3 = [
    'credentials' => [
        'key'    => 'your_s3_key',
        'secret' => 'your_s3_secret',
    ],
    'region' => 'ap-southeast-1',
    'version' => '2006-03-01',
];
$bucket = 'your_s3_bucket';
$key = 'environment/env.php'; //file path of env in S3 server
$filepath = '/home/deploy/.env.php'; //file path to download and save in server Api

$configLoadBalancer = $configEc2;
$configLoadBalancer['version'] = '2012-06-01';
$loadBalancerName = 'name_of_elb';

$instanceDeploy = [
    'username'  => 'deploy',
    'password'  => '',
    'key'       => '/home/deploy/.ssh/private_key_of_server_api',
    'keyphrase' => true,
    'agent'     => '',
    'db_role'   => true,
];

$branchDeploy = 'name_of_tag';
