<!DOCTYPE html>
<html lang="en">
<head>
<title>Review submission form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
 <div class="jumbotron text-center">
    <a href="TruthBombSite.html"><h1>Truth Bomb</h1></a>
    <p><h3>Website Review Form</h3></p>
 </div> 
<div class="container">  
   <form>    
      <div class="form-group">
	<label for="formName">Name:</label>
	<input type="text" class="form-control" id="formName" placeholder="Enter name">
      </div>
      <div class="form-group">
	<label for="formEmail">Email:</label>
	<input type="text" class="form-control" id="formEmail" placeholder="Your email">
      </div>
      <div class="form-group">
	<label for="formWebsite">Website Address:</label>
	<input type="text" class="form-control" id="formWebsite" placeholder="Website adress">
      </div>
      <div class="form-group">
	<label for="formComment">Comments:</label>
	<textarea class="form-control" rows="5" id="formComment" placeholder="Comments">
	</textarea>
      </div>
  </form>
  <div class="row">
    <div class="col-sm-1">
      <button type="button" class="btn btn-primary">Submit</button>
    </div>
    <div class="col-sm-1">
      <a href="TruthBombSite.html">
	<button type="button" class="btn btn-danger">Cancel</button>
      </a>
    </div>
  </div>
</body>
