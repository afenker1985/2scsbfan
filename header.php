<?php 	include $_SERVER['DOCUMENT_ROOT'].'/db/create_menu.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
	<meta charset="utf-8">
	<title>2scsbfan</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- CSS
   ================================================== -->
		<link rel="stylesheet" href="<?=$path?>css/base.css">
		<link rel="stylesheet" href="<?=$path?>css/layout.css">

	<!--[if lt IE 9]>
		<src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
	 <!-- Java Script
	================================================== -->
		   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!--   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script> -->

		<script src="<?=$path?>js/custom.js"></script>

</head>

<body>

   <div id="content-wrap">

      <!-- Header
      ================================================== -->
      <header class="container">

         <hgroup>
            <h1>2nd South Carolina String Band</h1>
            <h3>A Fan Site</h3>
         </hgroup>


         <nav id="nav-wrap" class="cf">

            <ul id="menu">
	            <li class="current"><a href="/">Home</a></li>
	            <li><a href="#">Albums</a>
                  <ul>
                     <?=$album_list?>
                  </ul>
               </li>
			   <li><a href="/links">Links</a></li>
	           <li><a href="#">About</a></li>
			   <li><a href="#">Contact</a></li>
            </ul> <!-- end #menu -->

         </nav>

      </header>