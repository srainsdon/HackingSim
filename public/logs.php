<html>
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>

</head>
<body>
<table id="LogTable">
    <tbody>
    </tbody>
</table>
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
                setTimeout(worker, 10000);
            }
        });
        var ajax_load = "<img src='/images/small-loading.gif' alt='loading...' />";

        // load() functions
        var loadUrl = "https://working-namespaces.herokuapp.com/LogAjax.php";

        this.find('tbody').empty().append(loadUrl);

// end
    });
</script>
</body>
</html>