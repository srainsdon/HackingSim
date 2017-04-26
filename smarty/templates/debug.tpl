{* Smarty *}

{capture name='_smarty_debug' assign=debug_output}
    <script type="text/javascript">
        // <![CDATA[
        var Smarty_debug = function Smarty_debug(collapsed){literal}{{/literal}

            var group = (collapsed) ? console.groupCollapsed : console.group;

            group("Smarty Debug"+ "{if isset($template_name)}{$template_name|debug_print_var nofilter}{else}Total Time {$execution_time|string_format:"%.5f"}{/if}");

            {if !empty($template_data)}
            group("Included templates & config files");
            {foreach $template_data as $template}
            console.log("{$template.name|escape:'javascript'}: (compile {$template['compile_time']|string_format:"%.5f"}) (render {$template['render_time']|string_format:"%.5f"}) (cache {$template['cache_time']|string_format:"%.5f"});");
            {/foreach}
            console.groupEnd();
            {/if}

            {if $assigned_vars != null}
            group("Assigned template variables");
            {foreach $assigned_vars as $vars}
            console.log("${$vars@key|escape:'html'}:", {$vars|@json_encode nofilter});
            {/foreach}
            console.groupEnd();
            {/if}

            group("Assigned config file variables (outer template scope)");
            {foreach $config_vars as $vars}
            console.log("{$vars@key|escape:'html'}:", {$vars|@json_encode nofilter});
            {/foreach}
            console.groupEnd();

            console.log("Smarty version", "{$smarty.version}");
            console.groupEnd();
            {*return "Smarty version {$smarty.version}";*}

            {literal}};{/literal}
        {*//Smarty_debug(false);*}
        // ]]>
    </script>
{/capture}
{$debug_output nofilter}