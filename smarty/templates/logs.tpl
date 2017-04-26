{extends file="main.tpl"}
{block name=body}
    <div id="main">
        <table id="appLog" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>timestamp</th>
                <th>logger</th>
                <th>level</th>
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
                <th>file</th>
                <th>line</th>
                <th>message</th>
            </tr>
            </tfoot>
        </table>
    </div>
{/block}

{block name=bottomScripts}
    <script>
        $('#appLog').DataTable({
            "ajax": {
                "url": "LogAjax.php",
                "type": "POST"
            }
        });
    </script>
{/block}