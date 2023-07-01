
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.0/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/jqueryScript/style.css') }}">

    <title>JWT Decoder Example</title>
</head>

<body class="p-3">
    <div class="container my-3">


<style>
.download{ padding: 1.25rem; border:0; border-radius:3px; background-color:#7B378E; color:#fff;cursor:pointer; text-decoration:none;}.download:hover{color: #fff}#carbonads{display:block;overflow:hidden;max-width:728px;position:relative;font-size:22px;box-sizing:content-box}#carbonads>span{display:block}#carbonads a{color:#4F46E5;text-decoration:none}#carbonads a:hover{color:#4F46E5}.carbon-wrap{display:flex;align-items:center}.carbon-img{display:block;margin:0;line-height:1}.carbon-img img{display:block;height:90px;width:auto}.carbon-text{display:block;padding:0 1em;line-height:1.35;text-align:left}.carbon-poweredby{display:block;position:absolute;bottom:0;right:0;padding:6px 10px;text-align:center;text-transform:uppercase;letter-spacing:.5px;font-weight:600;font-size:8px;border-top-left-radius:4px;line-height:1;color:#aaa!important}@media only screen and (min-width:320px) and (max-width:759px){.carbon-text{font-size:14px}}

.highlight-blue {
    width: 100%;
    display: block;
    background-color: lightblue;
}

.highlight-green {
    width: 100%;
    display: block;
    background-color: #7B378E;
}

.preview {
    background-color: #f5f5f5;
    border: 1px black;
    padding: 5px;
    width: 98%;
    max-height: 400px;
    /* overflow: auto; */
    overflow: hidden;
}

.thin-border {
    border: 1px blue dashed;
}

</style>
<div>
<p style="margin:2rem auto"><a class="download" href="{{ url('/home') }}">Back To Dashboard</a>
        <!-- <form> -->
        <div class="form-group">
            <label for="token">Encoded Token</label>
            <input type="text" class="form-control" id="token" aria-describedby="basic-addon3" value="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c">
        </div>
        <div class="form-group my-3">
            <label for="decoded">Payload</label>
            <textarea class="form-control" id="decoded" rows="6" readonly></textarea>
        </div>
        <div id="analyze" class="form-group">
            <label for="analyzed">Interesting Values</label>
            <pre id="out"></pre>
        </div>
        <button type="submit" class="btn btn-primary" id="decode">Decode</button>
        <!-- </form> -->

        <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jqueryScript/index.js') }}"></script>



</body>

</html>
