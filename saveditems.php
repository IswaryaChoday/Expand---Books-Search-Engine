<?php
  session_start();
  require('connection.php');
  require_once 'init.php';
  if(isset($_GET['book_id'])){

    $data = $_GET['book_id'];
    $user =$_SESSION['email'];

    $query = $es->search([
        'index'=> 'book',
      'type' => '_doc',
      'body' => [
         'query' => [
                  'match'  => ['_id' => $data],

         ]

      ]

   ]);
      if($query['hits']['total'] >= 1){
         $results = $query ['hits']['hits'];

         foreach($results as $r) {

            $authors=$r['_source']['authors'];
            $average_rating=$r['_source']['average_rating'];
            $title=$r['_source']['title'];


         }

         $sql = "INSERT INTO savedbooks (`user_id`, `id`, `authors`, `average_rating`, `title`) VALUES ('$user','$data', '$authors', '$average_rating', '$title')";
         $result = mysqli_query($link, $sql);
         echo"inserted";

      //   echo '<pre>', $total = $query['hits']['total']['value'], '</pre>';
      // $variables['total'] = $total;
        // echo '<pre>', print_r($results), '</pre>';
         //echo '<pre>', print_r($query['hits']['total']['value']), '</pre>';
      }

}
?>
