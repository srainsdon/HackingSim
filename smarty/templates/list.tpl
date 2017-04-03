{extends file="main.tpl"}
{block name=body}
    <table>
        <table id='computers' class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Network</th>
                <th>IP</th>
            </tr>
            </thead>
            <tbody>
            {foreach $computers as $computer}
                <tr class='clickable-row' data-href='./computer.php?compID={$computer.ComputerID}'>
                    <td>{$computer.ComputerName}</td>
                    <td>{$computer.NetworkName}</td>
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
            $('#computers').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderData: [1, 0]
                }]
            })
        });
    </script>
{/block}