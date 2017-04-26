<html>
<head>
    <script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>
<button id="loadbasic">basic load</button>
<div id="display_info">
</div>
<script>
    $(function () {
// don't cache ajax or content won't be fresh
        $.ajaxSetup({
            cache: false
        });
        var ajax_load = "<img src='http://i.imgur.com/pKopwXp.gif' alt='loading...'/>";

// load() functions
        var loadUrl = "/LogAjax.php";
        $("#loadbasic").click(function () {
            $("#display_info").html(ajax_load).load(loadUrl);
        });

// end
    });
</script>
</body>
</html>