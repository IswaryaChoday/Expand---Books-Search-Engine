<?php
require_once 'init.php';
session_start();
require('connection.php');
$user_id=$_SESSION['email'];

  $title = $_GET['title'];
  if(empty($title)){
    $title = $_GET['q'];
  }
  $author = $_GET['author'];
  $isbn = $_GET['isbn'];
  $average_rating = $_GET['average_rating'];
  $q = $title." ".$author." ".$isbn." ".$average_rating;
  $from =0;
  $size = 10;
	$query = $es->search([
		'index' => 'book',
    'from' => 0,
    'size'=> 1000,
		'type' => '_doc',
		'body' => [
		    'query' => [
                'multi_match' => ['query' => $q,
                     'fields' => ['title', 'author' ,'isbn', 'average_rating']]
		    ]
			]
	]);
	if($query['hits']['total'] >=1 ) {
		$results = $query['hits']['hits'];
	}
$total=$query['hits']['total']['value'];

function highlightWords($text,$word) {
	$text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $text);
	return $text;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Search | Online Books Search</title>
  <meta name="description" content="search-results">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styling.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="index.js"></script>
		<script type="text/javascript" src="result.js"></script>

  <style>
      h1 {
        font-family: Arvo, serif;
        text-align: center;
        font-size: 59px;
        position: relative;
        right: -130px;
      }
  </style>


</head>

<script type="text/javascript">
  $(document).ready(function(){
    var options={
      valueNames:['title','authors','isbn', 'average_rating'],
      page:10,
      pagination: true
    }
    var listObj = new List('listId',options);
  });
</script>
<body>
  <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
    <div class="container-fluid">
           <div class="navbar-header">
             <a href="mainpageloggedin.php" class="navbar-brand">Expand</a>
             <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                 <span style="color:blue" class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
            </div>
                 <div class="navbar-collapse collapse"id="navbarCollapse">
                 <ul class="nav navbar-nav">
                   <li><a href="profile.php">Profile</a></li>
                   <!-- <li><a href="#">Help</a></li> -->
                   <li><a href="add.php">Add Books</a></li>
                   <li ><a href=#>Favorites</a></li>
                   <li class="active"><a href="mainpageloggedin.php">Home</a></li>
                 </ul>
                 <ul class="nav navbar-nav navbar-right">
                     <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                   <li><a href="index.php?logout=1">Log out</a></li>
                 </ul>
                </div>
    </div>
  </nav>
<br>
<div class="row vertical-center-row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
					  <br><br><br><br><br><br>
            <center><h1>Expand</h1><p></center>

        </div>
    </div>
</div>

<br>
<br>
<form action="display2.php" method="get" autocomplete="on">
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
          <input type="text" name="q" class="search-query form-control" value="<?php echo $q; ?>" placeholder= "<?php echo $q ?>">
          <span class="input-group-btn">
              <button class="btn btn-danger" type="submit" value="search">
                  <span class=" glyphicon glyphicon-search"></span>
              </button>
          </span>
        </div>
    </div>

</div>
</form>
<br>

<br>
 <div class="container">
    <div class="row" style="text-align: center">
    <h2> Search Results: </h2>
    <?php
    echo "Number of results found :".$total; ?>
    </div>
  </div>


  	<div id="listId">
  		<ul class="list">
  			<?php echo $total ?>

  <?php
  for ($i=0; $i < $total; $i++) {
    ?>
    <div class="row" style="text-align: center">
      <div class="container">
        <div class="panel panel-success">
                    <div class=panel-heading>
                      <h2 class=panel-title>
                        <a href="<?php
                        $output=('http://52.73.241.4/Expand-Books-Search-Engine/singlebook.php?book_id='.$results[$i]['_id']);
                        // $output = ('https://www.google.com/search?q='.$r['_source']['title']);
                        echo($output);
                      ?>" ONCLICK=search_book('<?php echo $output; ?>') target="_blank"><p><br>
                          <?php $title1= !empty($title)?highlightWords($results[$i]['_source']['title'],$title):$results[$i]['_source']['title'];
                          echo $title1;?>
                        </a>
                    </div>
                      <br><br>
                        <b>Authors:</b><p>
                            <?php $authors= !empty($author)?highlightWords($results[$i]['_source']['authors'],$author):$results[$i]['_source']['authors'];
                            echo $authors; ?><p></p><br>
                        <b>Average Rating:</b><p>
                            <?php echo $results[$i]['_source']['average_rating']; ?><p></p><br>
                        <b>DocId:</b>
                          <center>
                              <?php echo $results[$i]['_id']; ?>
                          </center>
                        <br>
                        <input class="btn green save" method="POST" id=<?php echo $results[$i]['_id']; ?> name="Save" type="submit" value="Save">
                      <!-- <button type="button" class="btn btn-default" data-dismiss="modal"> -->
                </div>
              </div>
            </div>
          <?php
        }
           ?>
         </ul>
         <center><ul class="pagination"></ul></center>
       </div>
       <br><br>
             <!--Footer-->
             <div class="footer">
                 <div class="container">
                     <p>expand.com Copyright &copy;<?php $today = date("Y"); echo $today?>.</p>
                 </div>
             </div>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>
</html>
