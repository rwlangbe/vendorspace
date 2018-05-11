<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{  csrf_token() }}">
		<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

		<title>VendorSpace</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 

        <style>
        	div {
        		display: block;
        		font-size:10;
        	}

        	/* The navigation bar */
			.navbar {
			    background-color: #C2C2C2;
			    position: fixed; /* Set the navbar to fixed position */
			    top: 0; /* Position the navbar at the top of the page */
			    width: 100%; /* Full width */
			    left: 0;
			    z-index: 9999;
			    margin: 0;
			    min-width: 500px;
			}

			.nav-container {
				margin-left: 2%;
				margin-right: 6%;
			}

			/* Links inside the navbar */
			a.navbar  {
			    float: left;
			    display: block;
			    color: #f2f2f2;
			    text-align: center;
			    padding: 14px 16px;
			    text-decoration: none;
			    z-index: 9999;
			}

			/* Change background on mouse-over */
			a.navbar:hover {
			    background: #ddd;
			    color: black;
			    z-index: 9999;
			}

			.navbar-right {

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
				height: 260px;
			}

			.column {
			    float: left;
			}

			.left {
			    width: 29%;
			    padding: 4px;
			    margin-left: 1%;
			    float: left;
			    left: 0;
			}

			.middle {
			    width: 68%;
			    padding: 6%;
			}

			.center {
				text-align: center;
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
			    background-image: url({{ asset('img/settings-9-32.png') }});
			    display: block;
				margin-top: 10px;
				margin-left: 5px;
				text-indent: -9999px;
				width: 30px;
				height: 30px;
			}

			#app {
  				position: absolute;
        		top: 5%;
        		margin-left:60%;
        		width: 35%;
        		padding-left:10%;
        	}

        	.left-side {
        		padding-right:3%;
        		margin-left:3%;
        		width: 50%;
        	}

    	</style>

    	
	</head>
	<body>	
		<div>
			@include('templates.partials.navigation')
			<div id="app"> 
				<router-view></router-view>
		 		<div class="container">
		 			@include('templates.partials.alerts') 	
		 				
		 		</div>
			</div>
			<div class="left-side">
				@yield('content')
			</div>
		</div>

	 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="{{ asset('js/app.js') }}"></script>
	</body>
</html>