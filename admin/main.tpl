<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>{$title|default:'Welcome To the Game'}</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1><span class="glyphicons glyphicons-display"></span> {$title | default='Welcome To the Game'}</h1>
        <p><a href="https://github.com/werc/TreeTraversal">github.com/werc/TreeTraversal</a></p>
    </div>
    {block name=body}{/block}
</div>
</body>
</html>
