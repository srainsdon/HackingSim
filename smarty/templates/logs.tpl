{extends file="main.tpl"}
{block name=body}
    {if isset()}
        <table id="appLog" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>timestamp</th>
                <th>logger</th>
                <th>level</th>
                <th>thread</th>
                <th>file</th>
                <th>line</th>
                <th>message</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>timestamp</th>
                <th>logger</th>
                <th>level</th>
                <th>thread</th>
                <th>file</th>
                <th>line</th>
                <th>message</th>
            </tr>
            </tfoot>
        </table>
    {/if}
{/block}

{block name=bottomScripts}
    <script>
        $(document).ready(function ($) {
            $(".clickable-row").click(function () {
                window.location = $(this).data("href");
            });
        });
        $(document).ready(function () {
            $('#appLog').DataTable({
                "pageLength": 50
            })
        });
        var table = $('#appLog').DataTable({
            ajax: "/LogAjax.php"
        });

        setInterval(function () {
            table.ajax.reload();
        }, 30000);
    </script>
{/block}