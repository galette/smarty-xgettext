{if $issue_id}
    {_T 1=$issue_id string="View Note Details (Associated with Issue <a href=\"{$core.rel_url}view.php?id=%1\">#%1</a>)"}
{else}
    {_T string="View Note Details"}
{/if}

{*
this doesn't parse well, use this instead:

{_T escape=no 1=$issue_id 2="{$core.rel_url}view.php?id=$issue_id" string="View Note Details (Associated with Issue <a href=\"%2\">#%1</a>)"}
*}
