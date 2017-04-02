{extends file="main.tpl"}
{block name=body}
    <table>
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Computer ID</th>
                <th>Computer Name</th>
                <th>Computer IP</th>
            </tr>
            </thead>
            <tbody>
            {foreach $computers as $computer}
                <tr class='clickable-row' data-href='./tree.php?CompID={$computer.ComputerID}'>
                    <td>{$computer.ComputerID}</td>
                    <td>{$computer.ComputerName}</td>
                    <td>{$computer.ComputerIP}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </table>
{/block}
{block name=bottomScripts}
    <script>
        jQuery(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
{/block}