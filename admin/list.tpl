{extends file="main.tpl"}
{block name=body}
    <table>
        <table id='computers' class="table table-striped table-hover table-bordered">
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
                    <td>{$computer.ComputerHostName}</td>
                    <td>{$computer.ComputerDomain}</td>
                    <td>{$computer.ComputerIP}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </table>
{/block}
{block name=bottomScripts}
    <script>
        $(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
        $(document).ready(function () {
            $('#computers').DataTable();
        });
    </script>
{/block}