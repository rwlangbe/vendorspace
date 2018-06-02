<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{  csrf_token() }}">
		<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
		
		<title>VendorSpace</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
        <style>
        	div {
        		display: block;
        		font-size:10;
        	}

        	/* The navigation bar */
			.navbar {
			    background-color: #333333;
			    position: fixed; /* Set the navbar to fixed position */
			    top: 0; /* Position the navbar at the top of the page */
			    width: 100%; /* Full width */
			    left: 0;
			    z-index: 9999;
			    margin: 0;
			    min-width: 500px;
			}

			.navbar-default .navbar-brand {
				color: whitesmoke;
			}

			.navbar-default .navbar-nav>li>a {
				color: whitesmoke;
			}

			.nav-container {
				margin-left: 2%;
				margin-right: 6%;
			}

			/* Links inside the navbar */
			a.navbar  {
			    float: left;
			    display: block;
			    color: white;
			    text-align: center;
			    padding: 14px 16px;
			    text-decoration: none;
			    z-index: 9999;
			}

			.navbar-default .navbar-nav>li>a:hover {
				color: #111111;
				z-index: 9999;
			}
	        #myVideo {
			    left: 0;			   
			    height: 300px;
			    min-width: 100%; 
			    color: rgba(0, 0, 0, 0.2);
			}

			#country {
				width :100%;
				height :30px;
				margin-top: 5px;
			}	

			#submit_update {
				margin-top: 20px;
			}

			.viewport {
				background: rgba(255, 255, 255, 1);
				padding: 1px;
				margin: 2px;
		
				border-width: 5px;
				min-height: 200px;
				width: 97%;
				-webkit-transition: width .5s; /* Safari */
    			transition: width .5s;
			}

			.viewport:hover {
				min-width: 100%;
			}

			.video_background {
			    background: rgba(0, 0, 0, 0.5);
			    color: #CDCDCD;
			    left: 0;
			    width: 100%;
			    object-fit: fill;
			}

			.jumbo__header {
			    font-size: 5.0em;
			    text-shadow: 3px 1px;
			    font-weight: 500;
			    text-align: center;
			    margin-top: 20px;
			    color: #15CDCD;
			    padding-top: 50px;
			}

			.jumbo__subheader {
			    text-align: center;
			    margin-bottom: 25px;
			    color: rgba(119,119,119,.9);
			    font-size: 2.1em;
			}

			.top_border {
				top: 0;
				width: 100%;
				height: 120px;
			}

			.column {
			    float: left;
			}

			.left {
			    width: 25%;
			    padding: 4px;
			    margin-left: 1%;
			    float: left;
			    left: 0;
			}

			.middle {
			    width: 50%;
			    padding: 6%;
			}

			.center {
				text-align: center;
			}

			.right {
				position: absolute;
				right: 0;
				width: 34%;
			    padding: 4px;
			    margin-right: 1%;
			}

			.top-margin {
				margin-top: 40px;
			}

			.top-margin80 {
				margin-top: 80px;
			}

			.left-margin {
				margin-left: 50px;
			}

			#settings {  
				margin-top: 10px;
				margin-left: 5px;
				text-indent: -9999px;
				width: 30px;
				height: 30px;
				background-image: url( {{ asset('img/settings-9-32.png') }} );
			    display: block;
			}

			.left-side {
				position: absolute;
        		margin-top: 6%;
        		margin-left:3%;
        		width: 50%;
        		padding-left:3%;
        	}

        	#app {
        		position: absolute;
        		padding-right:3%;
        		margin-top:6%;
        		margin-left:3%;
        		width: 100%;
        	}
			#bottom-border {
				position: relative;
				margin-top:1000px;
				width: 100%;
			}

        	.container {
        		margin-right: 1%;
    			margin-left: 1%;
        	}

        	#middle_list {
        		text-align: left;
        	}

        	ul#heading_list {
        		list-style-image: url( {{ asset('img/settings-9-32.png') }} );
        	}

        	ul#heading_list li {
        		display: inline;
        	}

        	.listings {
				text-align: right;
			}

			.btn-caption {
				font-size:9;
				height:27px;
				width:60px;
			}

			.articlediv {
				border-style: outset;
				border-width: 4px;
				height: 700px;
				overflow: auto;
			}

			.windowed {
				border-style: none;
				border-width: 4px;
				height: 700px;
				overflow: auto;
			}

			.scrolling-wrapper {
				overflow-x: scroll;
				overflow-y: hidden;
				white-space: nowrap;

				.card {
					display: inline-block;
				}
			}

			#calendar_container {
				border-style: outset;
				border-width: 4px;
				padding: 15px;
				resize: both;
    			overflow: auto;

			}

			#event-list {
				display: none;
				margin-left: 20px;
			}

			.event_cal {
				background-color: #A2A242;
				padding-left: 5px;
				height: 15px;
				width: auto;
				margin-top:1px;
				font-size: 12px;
			}

			#event_sta {
				width: 150px;
			}

			#event_end {
				width: 150px;
			}

			#nonempty_select {
				display: "none";
				margin-left: 10px;				
			}

			#empty_select {
				margin-left: 10px;
			}		

			#cancel-event-list {
				margin-right: 10px;
			}
    	</style>
	</head>
	<body>	
		<div class="container">
			@include('templates.partials.alerts')
			@include('templates.partials.navigation')	
			<div id="app"> <!-- Javascript Layer -->
				<router-view></router-view>	
			</div>
			<div id="main">	
				<div class="left-side"> <!-- PHP Layer -->
					@yield('content')
				</div>
 			
			</div>
			<div id="alt_server">
				<div class="message"> <!-- PHP Layer -->
					@yield('content')
				</div>
			</div>
			<div id="bottom-border">
				<div class="border"></div>
			    <video id="main_video" class="video_background"  autoplay muted loop >  
			        <source src="{{ URL::asset('video\rain.mp4') }}" type="video/mp4">
			    </video>	
			</div>

		</div>
	 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="{{ asset('js/app.js') }}"></script>

		<script type="text/javascript">
			var url = window.location.href;
			var main = document.getElementById('main');
			var alt_server = document.getElementById('alt_server');
			var alt_script = document.getElementById('app');
			var bottom = document.getElementById('bottom-border');
			if( url.search( 'signin' ) > 0 || 
				url.search( 'signup' ) > 0 ||
				url.search( 'user' ) > 0 || 
				url.search( 'search' ) > 0 ||
				url.search( 'event' ) > 0 ) {				
				main.style.display = "none";
				alt_server.style.display = "block";
				alt_script.style.display = "none";
				bottom.style.display = "none";
			} else if ( url.search( 'landing') > 0 ||   
				url.search( 'friends') > 0 ){
				main.style.display = "block";
				alt_server.style.display = "none";
				alt_script.style.width = 34 + "%";
				alt_script.style.marginLeft = 65 + "%";
				alt_script.style.display = "block";
				bottom.style.display = "none";
			} else {
				main.style.display = "none";
				alt_server.style.display = "none";
				alt_script.style.width = 95 + "%";
				alt_script.style.marginLeft = 3 + "%";
				alt_script.style.marginRight = 3 + "%";
				alt_script.style.display = "block";
				bottom.style.display = "block";
			}
		</script>
	</body>
</html>
