
@extends('layout.main')

@section('content')



<form style="margin-left:150px;">
<input type="text" id='demo' value="#336699" />
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- JQUERY SCRIPT -->

  <script src="{{ asset('assets/js/jqueryScript/iris.js') }}"></script>
  <!-- END JQUERY SCRIPT -->

<script>
jQuery(document).ready(function($){
    $('#demo').iris({
		width: 300,
        hide: false,
		palettes: ['#125', '#459', '#78b', '#ab0', '#de3', '#f0f']
		});
});
</script>

@endsection
