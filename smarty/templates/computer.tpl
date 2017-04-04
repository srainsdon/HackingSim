{extends file="main.tpl"}

{block name=body}
    <h3>Editing: {$Computer.ComputerName}</h3>
    <form method="POST">
        <div class="form-group">
            <label for="computer_name">Host Name:</label><input id="computer_name" type="text" name="computer_name"
                                                                class="form-control" placeholder="Name"
                                                                {if isset($Computer.ComputerHostName)}value="{$Computer.ComputerHostName}">{/if}
        </div>
        <div class="form-group">
            <label for="domain_name">Domain Name:</label><input id="domain_name" type="text" name="domain_name"
                                                                class="form-control" placeholder="Name"
                                                                {if isset($Computer.ComputerDomain)}value="{$Computer.ComputerDomain}">{/if}
        </div>
        <div class="form-group">
            <label for="computer_ip">Domain IP:</label><input id="domain_ip" type="text" name="domain_ip"
                                                              class="form-control" placeholder="IP"
                                                              {if isset($Computer.ComputerIP)}value="{$Computer.ComputerIP}">{/if}
        </div>
        <div class="form-group">
            <label for="network_id">Network:</label><select name="network_id" id="network_id" class="form-control">
                {if isset($Networks)}
                    {html_options options=$Networks selected=$Computer.NetworkID}
                {else}
                    {html_options options=$Networks}
                {/if}
            </select>
        </div>
        &nbsp;
        <button type="submit" name="submit" value="{$task}" class="btn btn-default">{$task}</button>
    </form>
{/block}