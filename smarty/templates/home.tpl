{extends file="main.tpl"}
{block name=body}
    {if $LoggedIn}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading"><h3>My Computers: <span class="badge">{count($computers)}</span></h3></div>
            <div class="panel-body">
                {foreach $computers as $computer}
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <td>Name:</td>
                            <td>{$computer.ComputerName}</td>
                        </tr>
                        <tr>
                            <td>IP:</td>
                            <td>{$computer.ComputerIP}</td>
                        </tr>
                    </table>
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
        <h1>Please Log In.</h1>
    {/if}
{/block}