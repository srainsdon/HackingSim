<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <title>{$title|default:'Welcome'} - {$app_name}</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1><span class="glyphicon glyphicon-ok-circle"></span> {$title|default:'Welcome'} - {$app_name}</h1>
        <ul>
            {foreach $bCrumbs as $link}
                <li>{$link}</li>
            {/foreach}
        </ul>
    </div>
    {block name=body}{$body}{/block}
</div>
{block name=bottomScripts}{/block}
</body>
</html>
