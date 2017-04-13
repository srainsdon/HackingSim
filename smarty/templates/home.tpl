{extends file="main.tpl"}
{block name=body}
{if $LoggedIn}
    {foreach $computers as $computer}
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <td>Computer Name:</td>
                <td>{$computer.ComputerName}</td>
            </tr><tr>
                <td>Computer IP:</td>
                <td>{$computer.ComputerIP}</td>
            </tr>
        </table>
    {/foreach}
{/if}
{/block}