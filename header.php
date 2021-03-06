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
		<link rel="stylesheet" href="<?=$path?>css/my_layout.css">
		<link href="<?=$path?>js/jquery.zglossary.css" rel="stylesheet" type="text/css" />

	<!--[if lt IE 9]>
		<src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
	 <!-- Java Script
	================================================== -->
		   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!--   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script> -->

		<script src="<?=$path?>js/custom.js"></script>
		<script src="<?=$path?>js/jquery.zglossary.js" type="text/javascript"></script>
		<script>
		$(document).ready(function () {
		    $('body').glossary('<?=$path?>js/terms.json', {
		    	ignorecase: false,
				showonce: true
		    });
		});
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-16964230-1', 'auto');
		  ga('send', 'pageview');

		</script>
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
                     <?=$scsb->create_menu()?>
                  </ul>
               </li>
			   <li><a href="/links">Links</a></li>
	          <!-- <li><a href="#">About</a></li>
			   <li><a href="#">Contact</a></li>-->
            </ul> <!-- end #menu -->

         </nav>

      </header>