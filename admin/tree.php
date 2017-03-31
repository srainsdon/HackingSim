<?php
/*  
 * Example of using r_tree_traversal() MySQL stored procedure.
 */


error_reporting(E_ALL);
ini_set("display_errors", 1);

$dsn = 'mysql:host=34.208.253.55;dbname=HackingSim';
$pdo = new PDO($dsn, 'srainsdon', 'N0cand0a', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);

//inserting node
if (isset($_POST['insert'])) {
    $sql = "CALL r_tree_traversal('insert', NULL, {$_POST['parent_id']});";
    $prep = $pdo->prepare($sql);
    $prep->execute();
    $newNodeId = (int)$prep->fetchColumn();

    $sql = "INSERT INTO tree_content (node_id, name) VALUES (?,?)";
    $prep = $pdo->prepare($sql);
    $prep->execute(array($newNodeId, $_POST['node_name']));
}

//deleting node
if (isset($_POST['delete'])) {
    $sql = "CALL r_tree_traversal('delete', {$_POST['node_id']}, NULL);";
    $prep = $pdo->prepare($sql);
    $prep->execute();
}

//moving node
if (isset($_POST['move']) && ($_POST['node_id'] != $_POST['new_parent_id'])) {
    $sql = "CALL r_tree_traversal('move', {$_POST['node_id']}, {$_POST['new_parent_id']});";
    $prep = $pdo->prepare($sql);
    $prep->execute();
}

//order node in branch = same parent_id
if (isset($_POST['order']) && ($_POST['node_id'] != $_POST['under_node_id'])) {
    $sql = "CALL r_tree_traversal('order', {$_POST['node_id']}, {$_POST['under_node_id']});";
    $prep = $pdo->prepare($sql);
    $prep->execute();
}

//for HTML selects
$sql = "SELECT n.fsID, CONCAT(REPEAT('..', COUNT(CAST(p.fsID AS CHAR)) - 1), n.fsName) AS name"
    . " FROM FileSystems AS n, FileSystems AS p"
    . " WHERE (n.fsLft BETWEEN p.fsLft AND p.fsRgt) AND n.Computer = 3"
    . " GROUP BY n.Computer"
    . " ORDER BY n.fsLft;";
$prep = $pdo->prepare($sql);
$prep->execute();
$selectOptions = $prep->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Tree Traversal Examples</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1><span class="glyphicon glyphicon-tree-deciduous"></span> Tree Traversal Examples</h1>
        <p><a href="https://github.com/werc/TreeTraversal">github.com/werc/TreeTraversal</a></p>
    </div>
    <pre><?= $sql ?></pre>
    <pre>
<?php
//current tree structure
$tree = '';
foreach ($selectOptions as $key => $row) {
    $tree .= sprintf('%s' . PHP_EOL, $row->name);
}
echo rtrim($tree, PHP_EOL);
?>  
</pre>

    <br>
    <h3>Insert node</h3>
    <?php
    echo '<form method="POST" class="form-inline">';
    echo '<div class="form-group"><input type="text" name="node_name" class="form-control" placeholder="Name"></div>';
    echo '<div class="form-group">&nbsp;';
    echo '<select name="parent_id" class="form-control">';
    printf('<option value="%s">%s</option>', '', '- parent -');
    foreach ($selectOptions as $key => $row) {
        printf('<option value="%s">%s</option>', $row->node_id, $row->name);
    }
    echo '</select></div>';
    echo '&nbsp;<button type="submit" name="insert" class="btn btn-default">Insert</button>';
    echo '</form>';
    ?>

    <br>
    <h3>Delete node</h3>
    <?php
    echo '<form method="POST" class="form-inline">';
    echo '<div class="form-group">';
    echo '<select name="node_id" class="form-control">';
    foreach ($selectOptions as $key => $row) {
        if ($row->node_id > 1) { //do not delete root
            printf('<option value="%s">%s</option>', $row->node_id, $row->name);
        }
    }
    echo '</select></div>';
    echo '&nbsp;<button type="submit" name="delete" class="btn btn-default">Delete</button>';
    echo '</form>';
    ?>

    <br>
    <h3>Move node and leaves (if any)</h3>
    <?php
    echo '<form method="POST" class="form-inline">';
    echo '<div class="form-group">';
    echo '<select name="node_id" class="form-control">';
    printf('<option value="%s">%s</option>', '', '- move -');
    foreach ($selectOptions as $key => $row) {
        if ($row->node_id > 1) { //do not move root
            printf('<option value="%s">%s</option>', $row->node_id, $row->name);
        }
    }
    echo '</select></div>';
    echo '<div class="form-group">&nbsp;';
    echo '<select name="new_parent_id" class="form-control">';
    printf('<option value="%s">%s</option>', '', '- new parent -');
    foreach ($selectOptions as $key => $row) {
        printf('<option value="%s">%s</option>', $row->node_id, $row->name);
    }
    echo '</select></div>';
    echo '&nbsp;<button type="submit" name="move" class="btn btn-default">Move</button>';
    echo '</form>';
    ?>

    <br>
    <h3>Order in branch</h3>
    <?php
    echo '<form method="POST" class="form-inline">';
    echo '<div class="form-group">';
    echo '<select name="node_id" class="form-control">';
    printf('<option value="%s">%s</option>', '', '- order -');
    foreach ($selectOptions as $key => $row) {
        if ($row->node_id > 1) { //do not move root
            printf('<option value="%s">%s</option>', $row->node_id, $row->name);
        }
    }
    echo '</select></div>';
    echo '<div class="form-group">&nbsp;';
    echo '<select name="under_node_id" class="form-control">';
    printf('<option value="%s">%s</option>', '', '- under node with same parent! -');
    foreach ($selectOptions as $key => $row) {
        printf('<option value="%s">%s</option>', $row->node_id, $row->name);
    }
    echo '</select></div>';
    echo '&nbsp;<button type="submit" name="order" class="btn btn-default">Order</button>';
    echo '</form>';
    ?>
</div>
</body>
</html>
