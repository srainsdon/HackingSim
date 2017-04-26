<html>
<head>
    <script type="text/javascript" src="//code.jquery.com/jquery-3.2.1.js"></script>

</head>
<body>
<div class="excontainer">
    <button id="loadbasic">basic load</button>
    <div id="result"></div>

</div>
<script>
    // learn jquery ajax
    // http://net.tutsplus.com/tutorials/javascript-ajax/5-ways-to-make-ajax-calls-with-jquery/

    // no need to specify document ready

    $(function worker() {
        // don't cache ajax or content won't be fresh
        $.ajaxSetup({
            cache: false,
            complete: function () {
                // Schedule the next request when the current one's complete
                setTimeout(worker, 2000);
            }
        });
        var ajax_load = "<img src='http://automobiles.honda.com/images/current-offers/small-loading.gif' alt='loading...' />";

        // load() functions
        var loadUrl = "http://fiddle.jshell.net/dvb0wpLs/show/";

        $("#result").html(ajax_load).load(loadUrl);

// end
    });
</script>
</body>
</html>