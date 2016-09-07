<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
  	<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Wallys Watches</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="/#/">Home</a></li>
            <li><a href="/#/auction/buy">Buy</a></li>
            <li><a href="/#/auction/sell">Sell</a></li>
            <li ng-show="loggedIn" role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Profile <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/#/profile/{{loggedInUserID}}">View Profile</a></li>
                <li><a href="/#/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="MainContainer container">
  
    <div class="row">
      <div class="col-md-12">
        <h2>You dont have permission to view this page</h2>
      </div>
    </div>
    
    </div>


</body>
</html>
