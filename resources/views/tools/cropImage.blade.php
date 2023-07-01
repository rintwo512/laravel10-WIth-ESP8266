
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Crop Image</title>
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jqueryScript/pixelarity.css')}}">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>

        <!-- JQUERY SCRIPT -->
        <script src="{{ asset('assets/js/jqueryScript/pixelarity-face.js')}}"></script>
        <script src="{{ asset('assets/js/jqueryScript/script-face.js')}}"></script>
        <!-- END JQUERY SCRIPT -->
		<style type="text/css">
			#result{
				display: block;
				position: relative;
				margin-top: 40px;
			}
			.face{
				position: absolute;
				height: 0px;
				width: 0px;
				background-color: transparent;;
				border: 4px solid rgba(10,10,10,0.5);
			}
		</style>
	</head>
	<body>
        <h1><a href="{{ url('home') }}" style="text-decoration:none"> 👈 Back</a></h1>
		<div id="carbon-block" style="margin:30px auto"></div>

		<input id="file" type="file" >
		<img id="result">


	</body>
</html>
