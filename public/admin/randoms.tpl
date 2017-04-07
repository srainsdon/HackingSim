{extends file="main.tpl"}
{block name=body}
<table id="keyList" class="display" cellspacing="0" width="100%">
    <tbody>
    <tr>
    {foreach $strings as $value}
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
    {/foreach}
    </tr>
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
            $('#keyList').DataTable({
                "pageLength": 50,
                columnDefs: [{
                    targets: [0],
                    orderData: [1, 0]
                }]
            })
        });
    </script>
{/block}