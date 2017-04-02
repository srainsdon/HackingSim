<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>{$title|default:'Welcome To the Game'}</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1><span class="glyphicon glyphicon-ok-circle"></span> {$title|default:'Welcome To the Game'}</h1>
        <p>--Bread Crumbs--</p>
    </div>
    {block name=body}{/block}
</div>
</body>
</html>
