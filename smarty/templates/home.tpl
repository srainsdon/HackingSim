{extends file="main.tpl"}
{block name=body}
    {if $LoggedIn}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading"><h3>My Computers</h3> <span class="badge">{count($computers)}</span></div>
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
    {/if}
{/block}