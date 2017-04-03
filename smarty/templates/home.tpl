{extends file="main.tpl"}
{block name=body}
    {debug}
    {foreach $links as $name => $link}
        <h3><a href="{$link}">{$name}</a></h3>
    {/foreach}
{/block}