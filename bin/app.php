<?php

require __DIR__ . '/../vendor/autoload.php';


use Symfony\Component\Yaml\Yaml;

$configFile = __DIR__ . '/../etc/app.yml';

$config = Yaml::parse(file_get_contents($configFile));


$app    = new PriceTracker\App;
$client = new PriceTracker\Client;

$app->setConfig($config);
$app->init();
$app->setClient($client);
$app->fetch();
$app->output();
