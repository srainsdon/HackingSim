{extends file="home.tpl"}
{block name=MainPanel}
    <div class="form-group">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerHostName">Host Name:</label><input
                        id="ComputerHostName" type="text"
                        name="ComputerHostName"
                        class="input-sm form-control"
                        placeholder="Host Name">
            </div>
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerDomain">Domain Name:</label><input
                        id="ComputerDomain" type="text"
                        name="ComputerDomain"
                        class="input-sm form-control"
                        placeholder="Domain Name">
            </div>
            <div class="form-group">
                <label class="control-label input-sm col-sm-2" for="ComputerIP">IP Address:</label><input
                        id="ComputerIP" type="text"
                        name="ComputerIP"
                        class="input-sm form-control"
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
            <button type=" submit" name="submit" value="Add" class="btn btn-default btn-small"><span
                        class="glyphicon glyphicon-ok"/> Add
            </button>
        </form>
    </div>
{/block}