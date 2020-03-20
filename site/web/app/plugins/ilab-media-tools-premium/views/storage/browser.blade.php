@extends('../templates/sub-page', ['title' => $title])

@section('main')
    <div class="settings-body ilab-storage-browser">
        <div class="ilab-storage-browser-actions">
            @include('storage/browser-header', ['path' => $path])
            <div class="buttons">
                @if($allowUploads && $directUploads)
                <a href="#" class="button button-primary button-upload">@inline('ilab-ui-icon-upload.svg') Upload</a>
                <a href="#" class="button button-primary button-create-folder">@inline('ilab-ui-icon-create-folder.svg') Create Folder</a>
                @endif
                <a href="#" class="button button-primary button-import disabled">@inline('ilab-ui-icon-import.svg') Import</a>
                @if($allowDeleting)
                <a href="#" class="button button-delete disabled">@inline('ilab-ui-icon-trash.svg') Delete</a>
                @endif
            </div>
        </div>

        <div class="table-container">
            @include('storage/browser-table', ['files' => $files, 'allowDeleting' => $allowDeleting])
        </div>
    </div>
    <div id="ilab-storage-progress-modal" class="hidden">
        <div class="ilab-storage-progress-container">
            <div class="ilab-storage-progress-label">Deleting 'some-file.jpg'</div>
            <div class="ilab-storage-progress-bar">
                <div id="ilab-storage-progress"></div>
            </div>
        </div>
    </div>

    <div id="ilab-upload-target">
        Drop Files to Upload
    </div>

    <div id="ilab-upload-modal" class="hidden">
        <div id="ilab-upload-container">
            <div class="ilab-upload-header">Upload</div>
            <div class="ilab-upload-items">
                <div id="ilab-upload-items-container">
                    {{--<div class="ilab-upload-item">--}}
                        {{--<div class="ilab-upload-item-background"></div>--}}
                        {{--<div class="ilab-upload-status-container">--}}
                            {{--<div class="ilab-upload-status">Uploading ...</div>--}}
                            {{--<div class="ilab-upload-progress">--}}
                                {{--<div class="ilab-upload-progress-track" style="width: 64%;"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="ilab-loader-container" style="opacity:0;">--}}
                            {{--<div class="ilab-loader"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="ilab-upload-item">--}}
                        {{--<div class="ilab-upload-item-background"></div>--}}
                        {{--<div class="ilab-upload-status-container">--}}
                            {{--<div class="ilab-upload-status">Uploading ...</div>--}}
                            {{--<div class="ilab-upload-progress">--}}
                                {{--<div class="ilab-upload-progress-track" style="width: 64%;"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="ilab-loader-container" style="opacity:0;">--}}
                            {{--<div class="ilab-loader"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>

    <script type="text/template" id="tmpl-ilab-upload-cell">
        <div class="ilab-upload-item">
            <div class="ilab-upload-item-background"></div>
            <div class="ilab-upload-status-container">
                <div class="ilab-upload-status">Uploading ...</div>
                <div class="ilab-upload-progress">
                    <div class="ilab-upload-progress-track" style="width: 64%;"></div>
                </div>
            </div>
            <div class="ilab-loader-container" style="opacity:0;">
                <div class="ilab-loader"></div>
            </div>
        </div>
    </script>
    <script>
        var browserCurrentPath = "{{$path}}";
        var browserBaseURL = "{{admin_url('admin.php?page=media-tools-storage-browser')}}";
        var browserNonce = "{{wp_create_nonce('storage-browser')}}";

        jQuery(document).ready(function($){
            new ilabStorageBrowser($, {{($allowUploads && $directUploads) ? 'true' : 'false'}}, {{($allowDeleting) ? 'true' : 'false'}});
        });
    </script>
@endsection
