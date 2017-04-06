{extends file="main.tpl"}
{block name=body}
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">New Computer</a>
                </h4>
                <div id="collapse1" class="panel-collapse collapse">
                {include 'computer.tpl'}
                </div>
            <div class="panel-footer">Footer</div>
            </div>
        </div>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
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
                <tr class='clickable-row' data-href='/admin/computer/{$computer.ComputerID}'>
                    <td>{$computer.ComputerName}</td>
                    <td>{$computer.NetworkName}</td>
                    <td>{$computer.ComputerIP}</td>
                </tr>
            {/foreach}
            </tbody>
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
                "pageLength": 50,
                columnDefs: [{
                    targets: [0],
                    orderData: [1, 0]
                }]
            })
        });
    </script>
{/block}