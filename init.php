<?php

require '/var/www/html/Expand-Books-Search-Engine/vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$es = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
?>
