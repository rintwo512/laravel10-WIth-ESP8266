
<!doctype HTML>
<html>
	<head>
		<title>JSON Viewer</title>
		<meta charset="utf-8" />

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="{{ asset('assets/js/jqueryScript/jquery.json-viewer.js')}}"></script>
		<link href="{{ asset('assets/css/jqueryScript/jquery.json-viewer.css') }}
        ') }}" type="text/css" rel="stylesheet" />
		<style type="text/css">
body {
	margin: 0;
	font-family: sans-serif;
}
textarea#json-input {
	width: 50%;
	height: 200px;
    color:#08dd36;
}

.btn{
    margin:10px;
    padding:10px;
    width:200px;
}
.btn a{
    background:#7B378E;
    padding:10px;
    border-radius:5px;
    color:white;
    text-decoration:none;
}

.btnView{
    margin:10px;
    padding:10px;
}

.btnView button{
    background:#7B378E;
    padding:10px;
    border:none;
    border-radius:5px;
    color:white;
    outline:none;
}

textarea {
  margin-top: 10px;
  margin-left: 20px;
  /* width: 500px; */
  height: 100px;
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background: none repeat scroll 0 0 rgba(0, 0, 0, 0.07);
  border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
  border-image: none;
  border-radius: 6px 6px 6px 6px;
  border-style: none solid solid none;
  border-width: medium 1px 1px medium;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
  color: #555555;
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 1em;
  line-height: 1.4em;
  padding: 5px 8px;
  transition: background-color 0.2s ease 0s;
}


textarea:focus {
    background: none repeat scroll 0 0 #FFFFFF;
    outline-width: 0;
}
		</style>

		<script>
$(function() {
	$('#btn-json-viewer').click(function() {
		try {
			var input = eval('(' + $('#json-input').val() + ')');
			$('#json-renderer').json_viewer(input);
		}
		catch (error) {
			alert("Cannot eval JSON: " + error);
		}
	});

	// Display JSON sample on load
	$('#btn-json-viewer').click();
});
		</script>
	</head>
	<body>

        <div class="btn">
            <a href="{{ url('/home') }}">Back To Dashboard</a>
        </div>
		<textarea id="json-input" autocomplete="off">
{
  "id": 1001,
  "type": "donut",
  "name": "Cake",
  "price": 2.55,
  "available": true,
  "topping": [
    { "id": 5001, "type": "None" },
    { "id": 5002, "type": "Glazed" },
    { "id": 5005, "type": "Sugar" },
    { "id": 5006, "type": "Powdered Sugar" },
    { "id": 5003, "type": "Chocolate" },
    { "id": 5004, "type": "Maple" }
  ]
}</textarea>
<div class="btnView">
    <button id="btn-json-viewer">json-viewer</button>
</div>
		<pre id="json-renderer"></pre>
	</body>
</html>
