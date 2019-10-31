<?php
// php function to convert csv to json format

    if (($handle = fopen("./phone_dataset.csv", 'r')) === false) {
        die('Error opening file');
    }
    $fp = fopen('phone_dataset.json', 'w');
    $headers = fgetcsv($handle, 4000, ",");
    $csv2json = array();
    $count = 0;
    $i=0;
    while ($row = fgetcsv($handle, 4000, ",")) {
      $csv2json[$i] = '{"index":{"_id":"'.$count.'"}}'.PHP_EOL;
      // echo $csv2json[$i];
      fwrite($fp, $csv2json[$i]);
      $i++;
      $csv2json[$i] = json_encode(array_combine($headers, $row)).PHP_EOL;
      // echo $csv2json[$i];
      fwrite($fp, $csv2json[$i]);
      $i++;
      $count++;
    }
    fclose($handle);
?>
