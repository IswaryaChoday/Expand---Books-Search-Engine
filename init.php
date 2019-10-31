<?php

require '/Users/ishwaryabolla/Sites/vendor/autoload.php';
use Elasticsearch\ClientBuilder;
$es = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
?>
