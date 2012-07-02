<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Prototipo de Sistema Experto Recomendador de Restaurantes.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Prototipo de Sistema Experto Recomendador de Restaurantes. Proyecto de tesis.">
    <meta name="DC.Date" content="2012-07-16">
    

    <!-- Le styles -->
    
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    
    <!-- jquery ui styles -->
    <link href="<?php echo base_url();?>css/ui-lightness/jquery-ui-1.8.19.custom.css" rel="stylesheet">
    
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>	
    
    <link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!-- link rel="shortcut icon" href="/hondamania/img/favicon.ico" -->
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">PSERR</a>

          <div class="nav-collapse">

		<ul class="nav nav-pills">
		  
		  <!-- primer modulo -->
		  <li><a href="<?php echo base_url();?>">Inicio</a></li>
		  <li class="dropdown" id="menu1">
            
              

		</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <div class="container">
    