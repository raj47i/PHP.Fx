{foreach from=$Status key=Type item=Messages}
<div class="messages_{$type}">{$Type}:<br />
  <hr />
  <ul>
    {foreach from=$Messages item=Message}
    <li>{$Message}</li>
    {/foreach}
  </ul>
</div>
{/foreach}