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
            <tbody>
            {foreach $logs as $log}
                <tr>
                    <td>{$log.timestamp}</td>
                    <td>{$log.logger}</td>
                    <td>{$log.level}</td>
                    <td>{$log.file}</td>
                    <td>{$log.line}</td>
                    <td>{$log.message}</td>
                </tr>
            {/foreach}
            </tbody>
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
        $(document).ready(function () {
            $('#appLog').DataTable();
        });
    </script>
{/block}