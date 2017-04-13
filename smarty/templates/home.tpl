{extends file="main.tpl"}
{block name=body}
    {if $LoggedIn}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading"><h3>My Computers: <span class="badge">{count($computers)}</span></h3></div>
            <div class="panel-body">
                {foreach $MyNetworks as $Network}
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4>{$Network.Name}</h4></div>
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>NetID:</td>
                                    <td >{$Network.SubNetID}</td>
                                </tr>
                            </table>
                            {foreach $Network.Computer as $computer}
                                <a href="/computer/{$computer.ComputerIP}/">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td>Name:</td>
                                            <td>{$computer.ComputerName}</td>
                                        </tr>
                                        <tr>
                                            <td>IP:</td>
                                            <td>{$computer.ComputerIP}</td>
                                        </tr>
                                    </table>
                                </a>
                            {/foreach}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
        <div class="panel panel-default col-sm-8">
            {block name=MainPanel}
                <div class="panel-heading"><h3>Command Console:</h3></div>
                <div class="panel-body">
                    <div class="form-group">
                        <textarea class="form-control" rows="20">Disconnected...</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cmd">Command:</label>
                        <input type="text" class="form-control" id="cmd">
                    </div>
                </div>
            {/block}
        </div>
    {else}
        <h1>Welcome.</h1>
        <p>This is the game simulator. There will be more later.</p>
    {/if}
{/block}