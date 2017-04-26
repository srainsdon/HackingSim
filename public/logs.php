<html>
<head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">

        function loaddata() {
            var name = document.getElementById("username");

            if (name) {
                $.ajax({
                    type: 'post',
                    url: 'LogAjax.php',
                    data: {
                        timestamp: name,
                    },
                    success: function (response) {
                        // We get the element having id of display_info and put the response inside it
                        $('#display_info').html(response);
                    }
                });
            }

            else {
                $('#display_info').html("Please Enter Some Words");
            }
        }

    </script>

</head>
<body>

<input type="text" name="username" id="username" onkeyup="loaddata();">
<div id="display_info">
</div>

</body>
</html>