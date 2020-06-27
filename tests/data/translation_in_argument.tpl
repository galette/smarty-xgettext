{*
there's nested {_T} inside {reply_button}

how it's supposed to work?
old pattern parser was able to find this one!

how does smarty really handle this?
*}

{function name="reply_button" class="" title="" data=""}
    {strip}
        <a title="{$title}">
            <i class="fa fa-reply {$class}" {$data} aria-hidden="true"></i>
        </a>
    {/strip}
{/function}

{reply_button title="{_T string="reply as email"}" class="reply_as_email"}
