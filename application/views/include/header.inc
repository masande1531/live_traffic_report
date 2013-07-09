<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>SA Traffic Updates</title>
        <meta http-equiv="keywords" content="Live traffic reports, Traffic updates, Recent traffic activities, map view on traffic update, free traffic reports" />
        <meta http-equiv="description" content="Get your live traffic reports now ,When you travel to work you can easly access the live traffic "/>
        <link rel="SHORTCUT ICON" href="http://localhost/ci_traffic/images/icon.png"> 
        <link href="http://localhost/ci_traffic/css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="http://localhost/ci_traffic/css/map.css" />
        <script type="text/javascript" src="http://localhost/ci_traffic/js/OpenLayers-2.12.min.js"></script>
        <script type="text/javascript" src="http://localhost/ci_traffic/js/tomtom.map.js"></script>
        <link rel="stylesheet" type="text/css" href="http://localhost/ci_traffic/css/tomtom.map.min.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/ci_traffic/css/tomtom.controls.min.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="http://localhost/ci_traffic/css/tomtom.map.ie.min.css" /><![endif]-->
        <script type="text/javascript" src="http://localhost/ci_traffic/js/new/leaflet.js"></script>
        <script type="text/javascript" src="http://localhost/ci_traffic/js/new/tomtom.map.js"></script>
        <script type="text/javascript" src="http://localhost/ci_traffic/js/new/tomtom.controls.js"></script>

        <script type="text/javascript">
            if (screen.width <= 699) {
                document.location = "http://localhost/mobile_traffic/mobile/";
            }
            
   window.onload = function() {
              
        		// set the base image path, where all images will be loaded from
            	tomtom.setImagePath("images/");
        		
        		// create the tomtom map control
        		var map = new tomtom.Map({
        			domNode: "map",
                                apiKey: "zpzfq87gxbab9z6jfwbdze6d",
                                  panZoomBar: true,
        			displayTraffic: true,
        			cookie: true
        		});
        		
        		var routePlanner = new tomtom.controls.RoutePlannerControl({
        			map: map,
        			domNode: "tabs"
        		});
        		
        	};
          
        </script>
        <style type="text/css">


            #tabs {
                float: left;
                width: 21%;
                height: 110%;
               font-size: small;   
                  
            }

            #map {
                float: left;
                width: 75%;
                height: 80%;
                  
            }
        </style>
    </head>
       <style type="text/css">
        	#entryMap {
        		width: 100%;
        		height: 100%;
        		margin: 0;
        		padding: 0;
                     
                       
        	}
        </style>
    <body>

        <!-- start header -->

        <div id="header">
            <div id="logo">
                <h1><a href="<? echo base_url(); ?>">Traffic Updates<br/></a></h1>

            </div>
            <div id="menu">
                <ul>
                    <?php if(!$this->session->userdata('username')){ ?>
                    <li class="current_page_item"><a href="<?php echo base_url(); ?>index.php/page/login"><b>{</b>Login<b>}</b></a></li>
                    <?php }else{ ?>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/page/change_password" alt="profile"><b>{</b><?php echo ucfirst($this->session->userdata('username')); ?> </a></li>
                     <li class="current_page_item"><a href="<?php echo base_url(); ?>index.php/page/logout"> Logout<b>}</b></a></li>
                     <?php } ?>
                    <li><a href="<? echo base_url(); ?>">Home</a></li>			
                    <li class="current_page_item"><a href="<? echo base_url(); ?>index.php/about">About</a></li>
                    <li class="last"><a href="<? echo base_url(); ?>index.php/contact">Contact</a></li>
                    
            </div>
        </div>
        <!-- end header -->
