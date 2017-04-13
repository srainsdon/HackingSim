{extends file="main.tpl"}
{block name=body}
{if $LoggedIn}
    {foreach $computers as $computer}
        <div class="panel panel-default col-sm-4">
            <div class="panel-heading">My Computers</div>
            <div class="panel-body">
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <td>Computer Name:</td>
                        <td>{$computer.ComputerName}</td>
                    </tr><tr>
                        <td>Computer IP:</td>
                        <td>{$computer.ComputerIP}</td>
                    </tr>
                </table>
            </div>
        </div>

    {/foreach}
{/if}
{/block}