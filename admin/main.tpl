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
        <h1><span class="glyphicons glyphicons-display"></span> {$title|default:'Welcome To the Game'}</h1>
        <p><a href="https://github.com/werc/TreeTraversal">github.com/werc/TreeTraversal</a></p>
    </div>
    {block name=body}
        <h1>Welcome:h1</h1>
        <h2>Welcome:h2</h2>
        <h3>Welcome:h3</h3>
        <h4>Welcome:h4</h4>
        <h5>Welcome:h5</h5>
    {/block}
</div>
</body>
</html>
