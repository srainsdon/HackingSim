<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<table id="LogTable" class="table table-condensed">
    <thead>
    <tr>
        <th>Time Stamp</th>
        <th>Class</th>
        <th>Level</th>
        <th>Message</th>
        <th>File</th>
        <th>Line</th>
    </tr>
    </thead>
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

        $('#LogTable tbody').html(ajax_load).load(loadUrl);

// end
    });
</script>
</body>
</html>