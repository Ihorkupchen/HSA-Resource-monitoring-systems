<?php

use Elasticsearch\ClientBuilder;
use MongoDB\Client;

require 'vendor/autoload.php';

try {
    $mongoClient = new Client("mongodb://mongodb:27017");
    $collection = $mongoClient->test->items;
    $collection->insertOne(['name' => 'item1', 'value' => rand(1, 100)]);

    $elasticClient = ClientBuilder::create()->setHosts(['elasticsearch:9200'])->build();
    $params = [
            'index' => 'my_index',
            'body'  => ['testField' => 'abc']
    ];
    $response = $elasticClient->index($params);

    echo "Data inserted into MongoDB and Elasticsearch.";
} catch (Exception $e) {
    echo $e->getMessage();
}
// Підключення до MongoDB
