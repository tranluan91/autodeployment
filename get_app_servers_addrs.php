<?php

require '/home/deploy/.composer/vendor/autoload.php';
include dirname(__FILE__) . '/aws_config.php';

$instanceIps = [];
// Create a new AWS Elastic Load Balancing client using an array of configuration options
$client = \Aws\ElasticLoadBalancing\ElasticLoadBalancingClient::factory($configLoadBalancer);
// Get ELB informations by ELB's name
$result = $client->describeLoadBalancers(['LoadBalancerNames' => [$loadBalancerName]]);
// Get Public IP Address of instances
if (count($result['LoadBalancerDescriptions']) > 0) {
    $instanceIds = $result['LoadBalancerDescriptions'][0]['Instances'];
    if (count($instanceIds) > 0) {
        $ec2Client = \Aws\Ec2\Ec2Client::factory($configEc2);
        $instances = $ec2Client->describeInstances(['InstanceIds' => $instanceIds[0]]);
        foreach ($instances['Reservations'] as $instance) {
            foreach ($instance['Instances'] as $value) {
				$instanceIps[] = $value['PublicIpAddress'];
			}
        }
    }
}

$servers = [];
// Add host to instance deploy for server connections (Rocketeer'll use them)
foreach ($instanceIps as $host) {
    $instanceDeploy['host'] = $host;
    $servers[] = $instanceDeploy;
}

