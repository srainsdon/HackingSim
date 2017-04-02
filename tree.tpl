{extends file="main.tpl"}
{block name=body}
    <pre>
        {* File System Tree *}
</pre>
    <br>
    <h3>Insert node</h3>
    <form method="POST" class="form-inline">
        <div class="form-group"><input type="text" name="node_name" class="form-control" placeholder="Name"></div>
        <div class="form-group">&nbsp;<select name="parent_id" class="form-control">
                <option value="">- parent -</option>
                {* TODO insert "Insert Node" options here *}
            </select></div>
        &nbsp;
        <button type="submit" name="insert" class="btn btn-default">Insert</button>
    </form>
    <br>
    <h3>Delete node</h3>
    <form method="POST" class="form-inline">
        <div class="form-group"><select name="fsID" class="form-control">
                {* TODO insert "Delete Node" options here *}
            </select></div>
        &nbsp;
        <button type="submit" name="delete" class="btn btn-default">Delete</button>
    </form>
    <br>
    <h3>Move node and leaves (if any)</h3>
    <form method="POST" class="form-inline">
        <div class="form-group"><select name="fsID" class="form-control">
                <option value="">- move -</option>
                {* TODO insert "Move node and leaves" options here *}
            </select></div>
        <div class="form-group">&nbsp;<select name="new_parent_id" class="form-control">
                <option value="">- new parent -</option>
                {* TODO insert "Move node and leaves" options here *}
            </select></div>
        &nbsp;
        <button type="submit" name="move" class="btn btn-default">Move</button>
    </form>
    <br>
    <h3>Order in branch</h3>
    <form method="POST" class="form-inline">
        <div class="form-group"><select name="fsID" class="form-control">
                <option value="">- order -</option>
                {* TODO insert "Order Node" options here *}
            </select></div>
        <div class="form-group">&nbsp;<select name="under_fsID" class="form-control">
                <option value="">- under node with same parent! -</option>
                {* TODO insert "Order Node" options here *}
            </select></div>
        &nbsp;
        <button type="submit" name="order" class="btn btn-default">Order</button>
    </form>
{/block}