{extends file="main.tpl"}

{block name=body}
    <table>
        <table id='computers' class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Domain</th>
                <th>Bad IP</th>
                <th>New IP</th>
                <th>New Long</th>
            </tr>
            </thead>
            <tbody>
            {foreach $computers as $computer}
                <tr>
                    <td>{$computer.ComputerHostName}</td>
                    <td>{$computer.NetworkName}</td>
                    <td>{$computer.ComputerIP}</td>
                    <td>{$computer.NewIP}</td>
                    <td>{$computer.NewLong}</td>
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