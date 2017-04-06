{extends file="main.tpl"}

{block name=body}
    <h3>{if isset($Computer.ComputerName)}Editing: {$Computer.ComputerName}{else}New Computer{/if}</h3>
    <form method="POST" action="/admin/computer/">
        <div class="form-group">
            <label for="ComputerHostName">Host Name:</label><input id="ComputerHostName" type="text"
                                                                   name="ComputerHostName"
                                                                   class="form-control" placeholder="Host Name"
                                                                   {if isset($Computer.ComputerHostName)}value="{$Computer.ComputerHostName}"{/if}>
        </div>
        <div class="form-group">
            <label for="ComputerDomain">Domain Name:</label><input id="ComputerDomain" type="text" name="ComputerDomain"
                                                                   class="form-control" placeholder="Domain Name"
                                                                   {if isset($Computer.ComputerDomain)}value="{$Computer.ComputerDomain}"{/if}>
        </div>
        <div class="form-group">
            <label for="ComputerIP">IP Address:</label><input id="ComputerIP" type="text" name="ComputerIP"
                                                              class="form-control" placeholder="IP Address"
                                                              {if isset($Computer.ComputerIP)}value="{$Computer.ComputerIP}"{/if}>
        </div>
        <div class="form-group">
            <label for="ComputerNetwork">Network:</label><select name="ComputerNetwork" id="ComputerNetwork"
                                                                 class="form-control">
                {if isset($Computer)}
                    {html_options options=$Networks selected=$Computer.NetworkID}
                {else}
                    {html_options options=$Networks}
                {/if}
            </select>
        </div>
        &nbsp;{if isset($Computer)}
    <input type="hidden" name="ComputerID" value="{$Computer.ComputerID}">
        {/if}
        <button type=" submit" name="submit" value="{$task}" class="btn btn-default"><span
                    class="glyphicon glyphicon-ok"/> {$task}</button>
    </form>
{/block}