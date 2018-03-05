{if !empty($myfiles)}
    <table class="table table-inverse">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Body</th>
            <th>Status</th>
            <th>File</th>
        </tr>
        </thead>
        <tbody>
        {foreach $myfiles as $key => $item}
            <tr>
                <td>{$key+1}</td>
                <td>{$item.title}</td>
                <td>{$item.body}</td>
                <td>{$item.status}</td>
                <td><a href="{$smarty.const.IA_URL}uploads/{$item.upload_file[0]['path']}{$item.upload_file[0]['file']}"><i class="fa fa-download"></i></a></td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{else}
    <div class="alert alert-info">{lang key='no_myfiles_yet'}</div>
{/if}