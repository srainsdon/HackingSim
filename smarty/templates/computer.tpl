{extends file="main.tpl"}

{block name=body}
    <h3>{$Computer.ComputerName}</h3>
    <form method="POST"
    ">
    <div class="form-group">
        <label for="computer_name">Host Name:</label><input id="computer_name" type="text" name="computer_name"
                                                            class="form-control" placeholder="Name"
                                       value="{$Computer.ComputerHostName}"></div>
    <div class="form-group">
        <label for="domain_name">Domain Name:</label><input id="domain_name" type="text" name="domain_name"
                                                            class="form-control" placeholder="Name"
                                                            value="{$Computer.ComputerDomain}"></div>
    <div class="form-group">
    <div class="form-group">
        <label for="computer_ip">Domain Name:</label><input id="domain_ip" type="text" name="domain_ip"
                                                            class="form-control" placeholder="Name"
                                                            value="{$Computer.ComputerIP}"></div>
    <div class="form-group">
        <label for="network_id">Network:</label><select name="network_id" id="network_id" class="form-control">
                {foreach $Networks as $Network}
                    <option value="{$Network.NetworkID}">{$Network.NetworkName}</option>
                {/foreach}
            </select></div>
        &nbsp;
    <button type="submit" name="{$task}" class="btn btn-default">Insert</button>
    </form>
{/block}