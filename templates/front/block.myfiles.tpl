{if !empty($myfiles)}
    <ul class="list-group list-group-flush">
        {foreach $myfiles as $key => $item}
            <li class="list-group-item">{$item.title}
                <a href="{$smarty.const.IA_URL}uploads/{$item.upload_file[0]['path']}{$item.upload_file[0]['file']}"><i class="fa fa-download pull-right"></i></a>
            </li>
        {/foreach}
    </ul>

{else}
    <div class="alert alert-info">{lang key='no_myfiles_yet'}</div>
{/if}
