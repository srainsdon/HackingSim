<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    //cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css
    <title>{$title|default:'Welcome'} - {$app_name}</title>
</head>
<body>
<div class="container">

    {include 'nav_menu.tpl'}
    {if isset($bCrumbs)}
    <nav class="breadcrumb well-sm">
        {foreach $bCrumbs as $link}
            {$link}
        {/foreach}
    </nav>
    {/if}
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
    {block name=body}{$body|default:''}{/block}
</div>
{block name=bottomScripts}{/block}
</body>
<!-- {$userIP} -->
</html>
