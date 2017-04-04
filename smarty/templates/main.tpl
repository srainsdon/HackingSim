<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <title>{$title|default:'Welcome'} - {$app_name}</title>
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">{$app_name}</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="#">Page 2</a></li>
                {if ($LogedIn)}
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Network
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">main.slayer1of1.players.net</a></li>
                        <li><a href="#">...</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Panel
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/network/">Networks</a></li>
                        <li><a href="/admin/computer/">Computers</a></li>
                        <hr/>
                        <li><a href="/admin/computer/add/">Add Computer</a></li>
                        <li><a href="/admin/info/">PhpInfo</a></li>
                    </ul>
                </li>
                {/if}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                {if ($LogedIn)}
                    <li><a href="/profile/"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                {else}
                    <li><a href="/register/"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                {/if}
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
