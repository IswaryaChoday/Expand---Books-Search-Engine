<?php
require_once 'init.php';

  $title = $_GET['title'];
  $author = $_GET['author'];
  $isbn = $_GET['isbn'];
  $average_rating = $_GET['average_rating'];
  $q = $title." ".$author." ".$isbn." ".$average_rating;
	$query = $es->search([
		'index' => 'book',
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
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="search-results">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styling.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
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
<body>
<nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
  <div class="container-fluid">
         <div class="navbar-header">
           <a href="http://localhost/Web-Programming/mainpageloggedin.php" class="navbar-brand">Expand</a>
           <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
               <span style="color:blue" class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
           </button>
          </div>
               <div class="navbar-collapse collapse"id="navbarCollapse">
               <ul class="nav navbar-nav">
                 <li class="active"><a href="mainpageloggedin.php">Home</a></li>
                 <li><a href="add.php">Add Books</a></li>
                 <li><a href="#">Contact us</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                 <li><a href="#loginModal" data-toggle="modal">Login</a></li>
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
<form action="display.php" method="get" autocomplete="on">
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
          <input type="text" name="q" class="search-query form-control" placeholder="Search more"/>
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
    </div>
  </div>


        <?php
        if(isset($results)) {
            foreach($results as $r) {
            ?>

                <div class="row" style="text-align: center">
   		  <div class="container">
  		    <div class="panel panel-success">
                      <div class=panel-heading>
                        <h2 class=panel-title>
                          <a href="<?php echo $r['_source']['title']; ?>" target="_blank"><p><br>
                            <?php echo $r['_source']['title']; ?>
                          </a>
                      </div>
                        <br><br>
                          <b>Content:</b><p>
                              <?php echo $r['_source']['title']; ?><p></p><br>
                      <div class="">
                          <b>DocId:</b>
                            <center>
                                <?php echo $r['_id']; ?>
                            </center>
                          <br>
                    </div>
                  </div>
                </div>
            <?php
            }
        }

        ?>
</body>
</html>
