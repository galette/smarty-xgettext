{if $direction == "down"}
    {assign var="icon" value="fa-arrow-down"}
    {assign var="title" value="{_T string="move field down"}"}
{else}
    {assign var="icon" value="fa-arrow-up"}
    {assign var="title" value="{_T string="move field up"}"}
{/if}

{strip}
    <a href="{$href}" title="{$title}">
        <i class="fa {$icon}" aria-hidden="true"></i>
    </a>
{/strip}
