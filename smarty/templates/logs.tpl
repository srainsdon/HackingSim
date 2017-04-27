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
                <tr>{$log.timestamp}</tr>
                <tr>{$log.logger}</tr>
                <tr>{$log.level}</tr>
                <tr>{$log.file}</tr>
                <tr>{$log.line}</tr>
                <tr>{$log.message}</tr>
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