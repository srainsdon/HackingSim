{extends file="main.tpl"}
{block name=body}
{if $LoggedIn}
    {foreach $computers as $computer}
        <table>
            <tr>
                <td>Computer Name:</td>
                <td>{$computer.ComputerName}</td>
            </tr><tr>
                <td>Computer IP:</td>
                <td>{$computer.CIDR}</td>
            </tr><tr>
                <td>Network Name:</td>
                <td>{$computer.NetworkName}</td>
            </tr>
        </table>
    {/foreach}
{/if}
{/block}