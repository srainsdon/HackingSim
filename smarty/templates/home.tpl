{extends file="main.tpl"}
{block name=body}
    {if $LoggedIn}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading"><h3>My Computers: <span class="badge">{count($computers)}</span></h3></div>
            <div class="panel-body">
                {foreach $computers as $computer}
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <td>Computer Name:</td>
                            <td>{$computer.ComputerName}</td>
                        </tr>
                        <tr>
                            <td>Computer IP:</td>
                            <td>{$computer.ComputerIP}</td>
                        </tr>
                    </table>
                {/foreach}
            </div>
        </div>
        <div class="panel panel-default col-sm-8">
            <div class="panel-heading"><h3>Command Console:</h3></div>
            <div class="panel-body">
                <textarea rows="20">...</textarea>
            </div>
        </div>
    {/if}
{/block}