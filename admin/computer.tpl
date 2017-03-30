<!DOCTYPE html>
<html lang="en">
<head>
    <title>{$title|default:'Computer Info'}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-body">
                    {foreach $data as $key=>$var}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="{$key}">{$key}:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="{$key}" placeholder="{$key}" value="{$var}">
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>