{extends file="main.tpl"}
{block name=body}
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse1">New Network</a>
                </h4>
                <div id="collapse1" class="panel-collapse collapse">
                    <br/>
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="long1" value="{$ips.long1}">
                        <input type="hidden" name="long2" value="{$ips.long2}">
                        <div class="form-group"><input disabled="true" type="text" name="net_start" class="form-control"
                                                       value="{$ips.ip1}"></div>
                        <div class="form-group"><input disabled="true" type="text" name="net_end" class="form-control"
                                                       value="{$ips.ip2}"></div>
                        <div class="form-group"><input type="text" name="net_name" class="form-control"
                                                       placeholder="Name"></div>
                        &nbsp;
                        <button type="submit" name="new_net" class="btn btn-default">Add Network</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                    <td><span class="glyphicon glyphicon-pencil"/><span class="glyphicon glyphicon-remove"/></td>
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
                "pageLength": 50,
                columnDefs: [{
                    targets: [0],
                    orderData: [1, 0]
                }]
            })
        });
    </script>
{/block}