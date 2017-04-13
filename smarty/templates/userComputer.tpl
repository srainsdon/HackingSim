{extends file="home.tpl"}
{block name=MainPanel}
    <div class="form-group">
        <form method="POST">
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerHostName">Host Name:</label><input
                        id="ComputerHostName" type="text"
                        name="ComputerHostName"
                        class="input-sm form-control"
                        value="{$Computer.ComputerHostName}"
                        placeholder="Host Name">
            </div>
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerDomain">Domain Name:</label><input
                        id="ComputerDomain" type="text"
                        name="ComputerDomain"
                        class="input-sm form-control"
                        value="{$Computer.ComputerDomain}"
                        placeholder="Domain Name">
            </div>
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerIP">IP Address:</label><input
                        id="ComputerIP" type="text"
                        name="ComputerIP"
                        class="input-sm form-control"
                        value="{$Computer.ComputerIP}"
                        placeholder="IP Address">
            </div>
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerNetwork">Network:</label><select
                        name="ComputerNetwork"
                        id="ComputerNetwork"
                        class="input-sm form-control">
                    {if isset($Computer)}
                        {html_options options=$Networks selected=$Computer.NetworkID}
                    {else}
                        {html_options options=$Networks}
                    {/if}
                </select>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Services:</div>
                <div class="panel-body">
                    {foreach $Computer.ComputerServices as $service}
                        <div class="panel panel-default col-sm-6">
                            <div class="panel-body">
                                Service Name: {$service.name}<br />
                                Service Version: {$service.version}<br />
                                {foreach $service.ports as $port}
                                    Port {$port.port}: is {$port.status}{if isset($port.inbound)} to {$port.inbound}{/if}<br />
                                {/foreach}
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
            <button type=" submit" name="submit" value="Add" class="btn btn-default btn-small"><span
                        class="glyphicon glyphicon-ok"/> Submit
            </button>
        </form>
    </div>
{/block}