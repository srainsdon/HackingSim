{extends file="main.tpl"}

{block name=body}
    <pre>
    {foreach $Computer as $info}
        {$info}
    {/foreach}
    </pre>
    <h3>{$Computer.ComputerName}</h3>
    <form method="POST"
    ">
    <div class="form-group"><label for="computer_name">Host Name:</label>
        <input id="computer_name" type="text" name="computer_name" class="form-control" placeholder="Name"
                                       value="{$Computer.ComputerHostName}"></div>
    <div class="form-group"><label for="network_id">Network:</label>
        <select name="network_id" id="network_id" class="form-control">
                {foreach $Networks as $Network}
                    <option value="{$Network.NetworkID}">{$Network.NetworkName}</option>
                {/foreach}
            </select></div>
        &nbsp;
        <button type="submit" name="insert" class="btn btn-default">Insert</button>
    </form>
{/block}