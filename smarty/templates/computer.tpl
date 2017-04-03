{extends file="main.tpl"}

{block name=body}
    <pre>
    {foreach $computer as $info}
        {$info}
    {/foreach}
    </pre>
    <form method="POST" class="form-inline">
        <div class="form-group"><input type="text" name="computer_name" class="form-control" placeholder="Name"
                                       value="{$Computer.ComputerHostName}"></div>
        <div class="form-group">&nbsp;<select name="parent_id" class="form-control">
                {foreach $Networks as $Network}
                    <option value="{$Network.NetworkID}">{$Network.NetworkName}</option>
                {/foreach}
            </select></div>
        &nbsp;
        <button type="submit" name="insert" class="btn btn-default">Insert</button>
    </form>
{/block}