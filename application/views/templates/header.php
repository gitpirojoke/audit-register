<html>
	<head>
		<title>Audit Register</title>
<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url('vendor/assets/css/bootstrap.css');?><!--">-->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('vendor/assets/myCss.css');?>">
<!--        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<!--        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
		<!-- JavaScript Bundle with Popper -->
<!--		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>-->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Navigation -->
<div >
<!--  <header class="topbar">-->
<!--      <div class="container">-->
<!--        <div class="row">-->
<!--          <div class="col-sm-12">-->
<!--            <ul class="social-network">-->
<!--              <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-facebook"></i></a></li>-->
<!--              <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-twitter"></i></a></li>-->
<!--              <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-linkedin"></i></a></li>-->
<!--              <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-pinterest"></i></a></li>-->
<!--              <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-google-plus"></i></a></li>-->
<!--            </ul>-->
<!--          </div>-->
<!---->
<!--        </div>-->
<!--      </div>-->
<!--  </header>-->
  <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url();?>" style="text-transform: uppercase;">Аудит</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">

          <li id="main_nav" class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>">Главная</a>
          </li>

          <li id="registry_nav" class="nav-item">
            <a class="nav-link" href="<?php echo base_url('audit/');?>">Реестр</a>
          </li>

          <li id="info_nav" class="nav-item">
            <a class="nav-link" href="#">Справка</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
	<body>
        <div class="container">
<!--            <h1>--><?php //echo $title ?><!--</h1>-->
