{extends file="main.tpl"}
{block name=body}
    {if $LoggedIn}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading"><h3>My Networks: <span class="badge">{count($MyNetworks)}</span></h3></div>
            <div class="panel-body">
                {foreach $MyNetworks as $id => $Network}
                    <div class="panel panel-default">
                        <div class="panel-heading"><a data-toggle="collapse" href="#collapse{$id}">
                                <h4>{$Network.Name}: <span class="badge">{count($Network.Computer)}</span></h4></a></div>
                        <div id="collapse{$id}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>NetID:</td>
                                        <td>{$Network.SubNetID}</td>
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
                    </div>
                {/foreach}
            </div>
        </div>
        <div class="panel panel-default col-sm-8">
            {block name=MainPanel}
                <div class="panel-heading"><h3>Service Info</h3></div>
                <div class="panel-body">
                    {$data}
                </div>
            {/block}
        </div>
    {else}
        <h1>Welcome.</h1>
        <p>This is the game simulator. There will be more later.</p>
    {/if}
{/block}