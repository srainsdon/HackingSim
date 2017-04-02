{extends file="main.tpl"}
{block name=body}
    <table>
        <table id='networks' class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Start IP</th>
                <th>End IP</th>
            </tr>
            </thead>
            <tbody>
            {foreach $networks as $network}
                <tr>
                    <td>{$network.NetworkName}</td>
                    <td>{$network.NetworkStart}</td>
                    <td>{$network.NetworkEnd}</td>
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
            $('#networks').DataTable({
                columnDefs: [{
                    targets: [0],
                    orderData: [1, 0]
                }]
            })
        });
    </script>
{/block}