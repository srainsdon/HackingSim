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

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">{$app_name}</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="*" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Network
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">...</a>
                        <a class="dropdown-item" href="#">...</a>
                        <a class="dropdown-item" href="#">...</a>
                        <a class="dropdown-item" href="#">...</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/network/">Networks</a>
                        <a class="dropdown-item" href="/computer/">Computers</a>
                        <a class="dropdown-item" href="/computer/add/">Add Comupter</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="breadcrumb">
        {foreach $bCrumbs as $link}
            {$link}
        {/foreach}
    </nav>
    {if isset($message)}
        <br/>
        <div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert"
                                                                      aria-label="close">&times;</a>{$message|nl2br}
        </div>
    {/if}
    {if isset($alert)}
        <div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert"
                                                                     aria-label="close">&times;</a>{$alert|nl2br}
        </div>
    {/if}
    {block name=body}{$body}{/block}
</div>
{block name=bottomScripts}{/block}
</body>
</html>
