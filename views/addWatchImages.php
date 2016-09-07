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
<!-- This nav is a edited version of a bootstrap nav, i have kept the hamburger navigation features Changes are as follows
    # Aligment of nav items
    # Addition of dropdown which uses adaptive links
    # CSS styles (Colour, box shadow, Height , Border)
    # Hover Effects
    (TF) -->
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
        </div>
      </div>
    </nav>

    <div class="MainContainer container">
    
    <!-- Form using dropzone.js implementation (TF)-->
	<div class="row">
	<h3>Add Images to appear on watch profile</h3>
	<form action="uploadImage.php" class="dropzone" id="ImageUploader">
		  <div class="fallback">
		    <input name="file" type="file" multiple />
		  </div>
	</form>
</div>
<div class="row text-center">
	<h4>Drag and drop image or click for file upload - File automatically uploads on drop</h4>
</div>

<script type="text/javascript">
	
	Dropzone.options.ImageUploader = {

  		maxFilesize: 2,
      acceptedFiles: "image/*"
 	};
	
</script>

<!-- Form using dropzone.js implementation (TF)-->
<div class="row">
  <h3>Add Thumbnail for use around site.</h3>
  <form action="uploadThumbImage.php" class="dropzone" id="ImageThumbUploader">
      <div class="fallback">
        <input name="file" type="file" multiple />
      </div>
  </form>
</div>
<div class="row text-center">
  <h4>Drag and drop image or click for file upload - File automatically uploads on drop</h4>
</div>

<script type="text/javascript">
  
  Dropzone.options.ImageThumbUploader = {

      maxFilesize: 2,
      acceptedFiles: "image/*"
  };
  
</script>
</div>


</body>
</html>
