<?php /** @var \ILAB\MediaCloud\Cloud\Storage\StorageFile[] $files */ ?>
<table>
    <thead>
    <tr>
        <th><input type="checkbox"></th>
        <th>Name</th>
        <th>Last Modified</th>
        <th>Size</th>
        <th class="actions"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($files as $file)
        <tr data-file-type="{{strtolower($file->type())}}" data-key="{{$file->key()}}" @if($file->name() != '..')data-key="{{$file->key()}}"@endif>
            <td>
                @if($file->name() != '..')
                <input type="checkbox">
                @endif
            </td>
            <td class="entry">
                <img class="loader" src="{{admin_url('images/spinner.gif')}}">
                @if($file->name() == '..')

                <span class="icon-up"></span>
                @else
                <span class="icon-{{strtolower($file->type())}}"></span>
                @endif
                {!! $file->name() !!}
            </td>
            <td>{{$file->dateString()}}</td>
            <td>{{$file->sizeString()}}</td>
            <td class="actions">
                @if($file->type() == 'FILE')
                    <a href="{{(empty($file->url())) ? '#' : $file->url()}}" class="ilab-browser-action-view button button-small {{(empty($file->url())) ? 'disabled' : ''}}" target="_blank">View</a>
                    @if($allowDeleting)
                    <a href="#" class="ilab-browser-action-delete button button-small button-delete">Delete</a>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>