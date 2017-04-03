{extends file="main.tpl"}

{block name=body}
    <pre>
    {foreach $computer as $info}
        {$info}
    {/foreach}
</pre>
{/block}