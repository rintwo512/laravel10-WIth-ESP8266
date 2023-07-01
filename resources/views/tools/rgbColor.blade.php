
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$title}}</title>

 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jqueryScript/style.css') }}" />

 <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
 <script type='text/javascript' src='{{ asset('assets/js/jqueryScript/JBSlider.js') }}'></script>

 <style>
 body { font-family:'Roboto';}
 </style>

<div id='wrapper'>

	<div id='slider-wrapper'>
<h1><a href="{{ url('/home') }}" style="text-decoration:none">👈 Back</a></h1>
		<div id='slider-red-container'></div>
		<div id='info-red'>Logarithmic Red Channel</div>

		<div id='slider-green-container'></div>
		<div id='info-green'>Logarithmic Green Channel</div>

		<div id='slider-blue-container'></div>
		<div id='info-blue'>Logarithmic Blue Channel</div>

	</div>

</div>

<script type="text/javascript">

function init() {

	var slider_options = function(class_color) {

		var slider_opts = {
			id 			: 'slider-'+class_color+'-container',
			color 			: ''+class_color+'',
			background_content 	: '<div class="line"></div>',
			handle_content		: '<div class="slider"></div>',
			callback		: slider_changed
		};

		return slider_opts;
	}

	var slider_changed = function(value) {

		console.log(value);

	}

	var color = {

		red   : 'red',
		green : 'green',
		blue  : 'blue'

	};

	var slider_red   = new JBSlider(slider_options(color.red));

	var slider_green = new JBSlider(slider_options(color.green));

	var slider_blue  = new JBSlider(slider_options(color.blue));

}

</script>

</head>

<body onload='init()'>
</body>
</html>
